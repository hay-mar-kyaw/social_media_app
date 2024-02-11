<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Post,Comment};
use Illuminate\Support\Facades\{File,Auth};

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::latest()->paginate(10);
        return view('admin-panel.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin-panel.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);


        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('posts.index')->with('successMsg','You have successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comments=Comment::where('post_id',$id)->get();
        return view('admin-panel.posts.comment',compact('comments'));
    }

    public function showHide($id){
        $comment=Comment::find($id);
        $status=$comment->status=='show'?'hide':'show';

        $comment->update([
                    'status'=>$status,
                 ]);

        // if($comment->status=='show'){
        //     $comment->update([
        //         'status'=>'hide',
        //     ]);
        // }else{
        //     $comment->update([
        //         'status'=>'show',
        //     ]);
        // }
        return back()->with('successMsg','Comment status has been changed successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::find($id);

        return view('admin-panel.posts.edit',compact('post'));
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

        Post::find($id)->update($data);

        return redirect()->route('posts.index')->with('successMsg','You have successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('posts.index')->with('successMsg','You have successfully deleted');
    }
}
