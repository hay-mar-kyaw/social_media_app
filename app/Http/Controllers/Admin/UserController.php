<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view('admin-panel.users.index',compact('users'));
    }

    public function edit($id){
        $user=User::find($id);
        return view('admin-panel.users.edit',compact('user'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);
        User::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role
        ]);
        return redirect('admin/users')->with('successMsg','You are successfully updated');
    }

    public function destroy($id){
        User::find($id)->delete();
        return redirect('admin/users')->with('successMsg','You are successfully deleted');
    }
}
