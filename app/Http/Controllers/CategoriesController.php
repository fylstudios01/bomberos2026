<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use Validator;

class CategoriesController extends Controller
{
    private $name = 'categories';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Category::orderBy('id', 'desc')->paginate(10);

        return view('admin.categories.list')
            ->with('name', $this->name)
            ->with('rows', $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.categories.form')
            ->with('name', $this->name)
            ->with('request', $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $validation = $this->_validate_request($request);

        if(!$validation['success']){
            //Redirect
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validation['error']);
        }

        $register = Category::create([
            'name' => $request->name,
            'enabled' => $request->enabled
        ]);

        flash(trans('app.success.save'))->success();

        return redirect()->route($this->name.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Find the resource
        $register = $this->_check_register($id);

        if(!$register){
            return redirect()->route($this->name.'.index');
        }

        return view('admin.categories.form')
            ->with('name', $this->name)
            ->with('request', $request)
            ->with('register', $register);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Find the resource
        $register = $this->_check_register($id);

        if(!$register){
            return redirect()->route($this->name.'.index');
        }

        //Validation
        $validation = $this->_validate_request($request, $register->id);

        if(!$validation['success']){
            //Redirect
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validation['error']);
        }

        $register->update([
            'name' => $request->name,
            'enabled' => $request->enabled
        ]);

        flash(trans('app.success.update'))->success();

        return redirect()->route($this->name.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find the resource
        $register = $this->_check_register($id);

        if(!$register){
            return redirect()->route($this->name.'.index');
        }

        if($register->posts->count() > 0){
            //Disabled
            $register->update([
                'enabled' => 0
            ]);            
        }else{
            //Delete
            $register->delete();
        }

        flash(trans('app.success.delete'))->error();

        return redirect()->route($this->name.'.index');
    }

    private function _validate_request(Request $request, $id = null)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:categories,name'.($id != null ? ','.$id : ''),
            'enabled' => 'required|in:0,1'
        ]);
        
        if($validator->fails()){

            flash(implode(" ", $validator->errors()->all()))->error();

            return [
                'success' => false,
                'error' => $validator->errors()
            ];
        }

        return [
            'success' => true
        ];
    }

    private function _check_register($id)
    {
        //Find the resource
        $register = Category::find($id);
        //Verify
        if(!$register){
            flash(trans('app.errors.not_found'))->error();

            //Redirect
            return false;
        }
        //Return
        return $register;
    }
}
