<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request,$postId){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $request->validate([
            'text'=>'required',
        ]);
        Comment::create([
            'post_id'=>$postId,
            'user_id'=>Auth::user()->id,
            'text'=>$request->text,
        ]);

        return back();
    }

    public function commentedit(string $id)
    {
        $comment=Comment::find($id);

        return view('ui-panel.detail',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function commentupdate(Request $request, string $id)
    {
        $data=$request->validate([
            'text'=>'required',

        ]);

        Comment::find($id)->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function commentdelete(string $id)
    {
        $comment=Comment::find($id);
        $comment->delete();
        return back();
    }
}
