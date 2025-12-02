<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;

use Mail;
use Validator;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestNews = Post::where('publish', 1)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        return view('front.home')
            ->with('latestNews', $latestNews);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts(Request $request)
    {
        $category = false;
        //CHeck
        if(isset($request->category)){
            $category = Category::findBySlug($request->category);
        }

        $posts = Post::where('publish', 1)
            ->when($category, function($query) use ($category){
                return $query->where('category_id', $category->id);
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view('front.news')
            ->with('request', $request)
            ->with('category', $category)
            ->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postView($slug)
    {
        $post = Post::findBySlug($slug);

        if(!$post){
            return redirect('/');
        }

        $latestNews = Post::where('publish', 1)
            ->where('id', '<>', $post->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        return view('front.news-view')
            ->with('post', $post)
            ->with('latestNews', $latestNews);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template-contactform-name' => 'required',
            'template-contactform-email' => 'required|email',
            'template-contactform-phone' => 'required',
            'subject' => 'required',
            'address' => 'required',
            'template-contactform-message' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'alert' => "error",
                'message' => "Debe completar todos los campos. <br><br><strong>Motivo:</strong><br>".implode(" ", $validator->errors()->all())
            ]);
        }

        //Armo msg
        $msg = "Nombre: ".$request['template-contactform-name'];
        $msg = "\r\nEmail: ".$request['template-contactform-email'];
        $msg = "\r\nTeléfono: ".$request['template-contactform-phone'];
        $msg = "\r\nAsunto: ".$request['subject'];
        $msg = "\r\nDirección: ".$request['address'];
        $msg = "\r\nMensaje: ".$request['template-contactform-message'];

        try{
            Mail::raw($msg, function ($message) use ($request){
                $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                $message->to(env('VOL_MAIL'));
                $message->subject('Contacto desde Web - Voluntariado');
            });

            return response()->json([
                'alert' => 'success',
                'message' => 'Gracias por contactarnos, le responderemos a la brevedad posible.'
            ]);
        }catch(\Exception $e){
            //Response
            return response()->json([
                'alert' => "error",
                'message' => "Error al conectarse al servidor. <br><br><strong>Motivo:</strong><br>".$e->getMessage()
            ]);
        }
    }
}
