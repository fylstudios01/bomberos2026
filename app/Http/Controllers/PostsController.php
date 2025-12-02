<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostPhoto;

use Validator;
use Image;
use Log;
use Storage;
use Str;

class PostsController extends Controller
{
    private $name = 'posts';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Post::orderBy('id', 'desc')->paginate(10);

        return view('admin.posts.list')
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
        $categories = $this->_categories();

        return view('admin.posts.form')
            ->with('name', $this->name)
            ->with('request', $request)
            ->with('categories', $categories);
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

        $register = Post::create([
    'title'        => $request->title,
    'category_id'  => $request->category_id,
    'content'      => $request->content,
    'publish'      => $request->publish,
    'published_at' => $request->publish == 1 ? date('Y-m-d H:i:s') : null,
    'user_id'      => auth()->user()->id,
    'author_name'  => auth()->user()->name   // ← CLAVE
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

        $categories = $this->_categories();

        return view('admin.posts.form')
            ->with('name', $this->name)
            ->with('request', $request)
            ->with('register', $register)
            ->with('categories', $categories);
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

        $published_at = $register->published_at != null ? $register->published_at : null;

        $register->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'publish' => $request->publish,
            'published_at' => $request->publish == 1 && $register->published_at == null ? date('Y-m-d H:i:s') : $published_at
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
    // Buscar el post
    $post = $this->_check_register($id);

    if(!$post){
        return redirect()->route($this->name.'.index');
    }

    // 1. Eliminar fotos asociadas
    foreach ($post->photos as $photo) {
        // Borrar archivos físicos
        Storage::disk('photo')->delete($photo->path.'IMG0_'.$photo->filename);
        Storage::disk('photo')->delete($photo->path.'IMG1_'.$photo->filename);

        // Borrar fila en la tabla post_photos
        $photo->delete();
    }

    // 2. Eliminar el post
    $post->delete();

    flash(trans('app.success.delete'))->error();

    return redirect()->route($this->name.'.index');
}


    private function _validate_request(Request $request, $id = null)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:150|unique:posts,title'.($id != null ? ','.$id : ''),
            'category_id' => 'required|numeric',
            'content' => 'nullable',
            'publish' => 'required|in:0,1',
            'published_at' => 'nullable|date_format:Y-m-d H:i:s'
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
        $register = Post::find($id);
        //Verify
        if(!$register){
            flash(trans('app.errors.not_found'))->error();

            //Redirect
            return false;
        }
        //Return
        return $register;
    }

    private function _categories()
    {
        return Category::whereEnabled(1)->orderBy('name', 'asc')->pluck('name', 'id');
    }


    //Photos

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function photosIndex($post_id)
    {
        //Find the resource
        $register = $this->_check_register($post_id);

        if(!$register){
            return redirect()->route($this->name.'.photos.index');
        }

        $rows = PostPhoto::where('post_id', $post_id)->orderBy('id', 'desc')->get();

        return view('admin.posts.photos.list')
            ->with('name', $this->name)
            ->with('register', $register)
            ->with('rows', $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function photosCreate(Request $request, $post_id)
    {
        //Find the resource
        $register = $this->_check_register($post_id);

        if(!$register){
            return redirect()->route($this->name.'.photos.index');
        }

        return view('admin.posts.photos.form')
            ->with('name', $this->name)
            ->with('request', $request)
            ->with('register', $register);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function photosStore(Request $request, $post_id)
    {
        //Find the resource
        $register = $this->_check_register($post_id);

        if(!$register){
            return redirect()->route($this->name.'.photos.index');
        }

        //Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:150',
            'photo' => 'required|image|max:4096|dimensions:min_width='.env('NEWS_IMG1_W').',min_height='.env('NEWS_IMG1_H') 
        ]);

        if($validator->fails()){
            flash(implode(" ", $validator->errors()->all()))->error();
            //Redirect
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $photo = $request->file('photo');
        $fileName = Str::uuid().'.'.env('NEWS_IMG_EXT');
        $folder = $register->id;

        //Image 0
        $res0 = $this->_create_image($photo, $fileName, 0, $folder);
        //Image 1
        $res1 = $this->_create_image($photo, $fileName, 1, $folder, $request);

        if(!$res0['success']){
            flash('ERROR: '.trans('app.errors.photo_upload'))->error();
            return redirect()->back();
        }

        PostPhoto::create([
            'post_id' => $register->id,
            'title' => $request->title,
            'path' => $register->id.'/',
            'filename' => $fileName,
            'user_id' => auth()->user()->id
        ]);

        flash(trans('app.success.photo_load'))->success();

        return redirect()->route($this->name.'.photos.index', $register);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photosDestroy($post_id, $id)
    {
        //Find the resource
        $register = $this->_check_register($post_id);

        if(!$register){
            return redirect()->route($this->name.'.index');
        }

        //Find the photo
        $photo = PostPhoto::where('post_id', $register->id)
            ->where('id', $id)
            ->first();

        if(!$photo){
            flash('ERROR: '.trans('app.errors.photo_not_found'))->error();
            return redirect()->route($this->name.'.photos.index', $register);
        }

        Storage::disk('photo')->delete($photo->path.'IMG0_'.$photo->filename);
        Storage::disk('photo')->delete($photo->path.'IMG1_'.$photo->filename);

        //Delete
        $photo->delete();

        flash(trans('app.success.delete'))->error();

        return redirect()->route($this->name.'.photos.index', $register);
    }

    private function _create_image($file, $fileName, $size, $folder, $request = false)
    {
        try{
            $img = Image::make($file);
            $img->orientate();

            if($size == 0){
                $img->resize(env('NEWS_IMG'.$size.'_W'), null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $img->crop(intval($request['crop-w']), intval($request['crop-h']), intval($request['crop-x']), intval($request['crop-y']));
                $img->fit(env('NEWS_IMG'.$size.'_W'), env('NEWS_IMG'.$size.'_H'), function ($constraint) {
                    $constraint->upsize();
                });
            }
            
            //Save
            $imgStream = $img->stream(env('NEWS_IMG_EXT'), 70);
            //Store
            Storage::disk('photo')->put($folder.'/IMG'.$size.'_'.$fileName, $imgStream);

            return [
                'success' => true
            ];
        }catch(\Exception $e){
            dd($e);
            //Log error
            Log::error($e->getTraceAsString());
            //Message
            return [
                'success' => false
            ];
        }
    }
}
