<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post,Comment};

class UIController extends Controller
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
     * Display the specified resource.
     */
    public function postdetail(string $id)
    {
        $post=Post::find($id);
        $comments=Comment::where('post_id',$id)->where('status','show')->get();
        return view('ui-panel.detail',compact('post','comments'));
    }


}
