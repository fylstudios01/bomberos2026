<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hierarchy;
use Validator;
use PDF;

class UsersController extends Controller
{
    private $name = 'users';

    /* =======================================================
     * LISTADO + BUSQUEDA + FILTROS AVANZADOS
     * ======================================================= */
    public function index(Request $request)
    {
        $query = User::with('hierarchy');

        // Buscador en tiempo real (nombre, apellido, legajo)
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('last_name', 'LIKE', "%$search%")
                  ->orWhere('legajo_number', 'LIKE', "%$search%");
            });
        }

        // Filtrar por jerarquía
        if ($request->hierarchy_id != "") {
            $query->where('hierarchy_id', $request->hierarchy_id);
        }

        // Filtrar por estado
        if ($request->enabled != "") {
            $query->where('enabled', $request->enabled);
        }

        // Filtros avanzados
        switch ($request->order) {
            case "az":
                $query->orderBy('last_name', 'asc');
                break;

            case "za":
                $query->orderBy('last_name', 'desc');
                break;

            case "hierarchy_high":
                $query->orderBy('hierarchy_id', 'desc');
                break;

            case "hierarchy_low":
                $query->orderBy('hierarchy_id', 'asc');
                break;

            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $rows = $query->paginate(20);
        $hierarchies = Hierarchy::orderBy('level')->get();

        return view('admin.users.list', [
            'name' => $this->name,
            'rows' => $rows,
            'hierarchies' => $hierarchies,
            'request' => $request
        ]);
    }

    /* =======================================================
     * VISTA DE PERFIL (FICHA POLICIAL)
     * ======================================================= */
    public function show($id)
    {
        $user = User::with('hierarchy')->find($id);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.show', compact('user'));
    }

    /* =======================================================
     * CREAR
     * ======================================================= */
    public function create(Request $request)
    {
        $hierarchies = Hierarchy::orderBy('level')->get();

        return view('admin.users.form', [
            'name' => $this->name,
            'request' => $request,
            'hierarchies' => $hierarchies
        ]);
    }

    /* =======================================================
     * GUARDAR
     * ======================================================= */
    public function store(Request $request)
    {
        $validation = $this->_validate_request($request);

        if (!$validation['success']) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validation['error']);
        }

        User::create([
            'name'          => $request->name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'dni'           => $request->dni,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'birthdate'     => $request->birthdate,
            'legajo_number' => $request->legajo_number,
            'ingreso_date'  => $request->ingreso_date,
            'hierarchy_id'  => $request->hierarchy_id,
            'enabled'       => $request->enabled,
        ]);

        flash('Usuario creado correctamente')->success();
        return redirect()->route($this->name.'.index');
    }

    /* =======================================================
     * EDITAR
     * ======================================================= */
    public function edit(Request $request, $id)
    {
        $register = $this->_check_register($id);

        if (!$register) return redirect()->route($this->name.'.index');

        $hierarchies = Hierarchy::orderBy('level')->get();

        return view('admin.users.form', [
            'name' => $this->name,
            'request' => $request,
            'register' => $register,
            'hierarchies' => $hierarchies
        ]);
    }

    /* =======================================================
     * ACTUALIZAR
     * ======================================================= */
    public function update(Request $request, $id)
    {
        $register = $this->_check_register($id);
        if (!$register) return redirect()->route($this->name.'.index');

        $validation = $this->_validate_request($request, $register->id);

        if (!$validation['success']) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validation['error']);
        }

        $data = [
            'name'          => $request->name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'dni'           => $request->dni,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'birthdate'     => $request->birthdate,
            'legajo_number' => $request->legajo_number,
            'hierarchy_id'  => $request->hierarchy_id,
            'ingreso_date'  => $request->ingreso_date,
            'enabled'       => $request->enabled,
        ];

        if ($request->password != null && trim($request->password) !== '') {
            $data['password'] = bcrypt($request->password);
        }

        $register->update($data);

        flash('Usuario actualizado correctamente')->success();
        return redirect()->route($this->name.'.index');
    }

    /* =======================================================
     * ELIMINAR
     * ======================================================= */
    public function destroy($id)
    {
        $register = $this->_check_register($id);

        if (!$register || auth()->user()->id == $register->id) {
            return redirect()->route($this->name.'.index');
        }

        if (method_exists($register, 'posts') && $register->posts()->count() > 0) {
            $register->update(['enabled' => 0]);
            flash('Usuario con publicaciones → deshabilitado.')->warning();
            return redirect()->route($this->name.'.index');
        }

        $register->delete();

        flash('Usuario eliminado')->error();
        return redirect()->route($this->name.'.index');
    }

    /* =======================================================
     * PDF PROFESIONAL DE LEGAJO
     * ======================================================= */
    public function generatePDF($id)
    {
        $user = User::with('hierarchy')->findOrFail($id);

        $pdf = PDF::loadView('admin.users.pdf', compact('user'))
                  ->setPaper('A4', 'portrait');

        $filename = 'Legajo_' . ($user->legajo_number ?: 'SIN-LEGAJO') . '_' . $user->last_name . '.pdf';

        return $pdf->stream($filename);
    }

    /* =======================================================
     * VALIDACIONES
     * ======================================================= */
    private function _validate_request(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:100',
            'last_name'     => 'required|max:100',
            'email'         => 'required|max:150|email|unique:users,email' . ($id ? ",$id" : ''),
            'dni'           => 'nullable|max:20',
            'phone'         => 'nullable|max:50',
            'address'       => 'nullable|max:255',
            'birthdate'     => 'nullable|date',
            'legajo_number' => 'nullable|max:50',
            'ingreso_date'  => 'nullable|date',
            'hierarchy_id'  => 'nullable|integer',
            'enabled'       => 'required|boolean',
            'password'      => $id ? 'nullable|min:6|confirmed' : 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'error' => $validator->errors()];
        }

        return ['success' => true];
    }

    /* =======================================================
     * CHECK EXISTENCIA
     * ======================================================= */
    private function _check_register($id)
    {
        $register = User::find($id);

        if (!$register) {
            flash('Registro no encontrado')->error();
            return false;
        }

        return $register;
    }
}
