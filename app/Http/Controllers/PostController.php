<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post,Comment};
use Illuminate\Support\Facades\{Auth,Gate};

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::latest()->paginate(5);
        return view('ui-panel.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);


        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::user()->id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function postdetail(string $id)
    {
        $post=Post::find($id);
        $comments=Comment::where('post_id',$id)->where('status','show')->get();
        return view('ui-panel.detail',compact('post','comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);

        $post=Post::find($id);
        if(Gate::denies('view-post',$post)){
            return back();
        }

        $post->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);
        if(Gate::denies('view-post',$post)){
            return back();
        }

            $post->delete();
            return back();

    }
}




