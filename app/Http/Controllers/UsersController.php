<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\User;
class UsersController extends Controller
{
     public function index(){
    	return view('users.index')->with('users',User::all());
    }

          public function makeAdmin(User $user){

    	
        $user->role='admin';
    	$user->save();

    	session()->flash('success','User role changed to admin');
       return redirect()->route('users.index');

    }

     public function edit(){
    	return view('users.edit')->with('user',auth()->user());
    }

      public function update(UpdateProfileRequest $request,User $user){

        $user=auth()->user();
        $user->name=$request->name;
        $user->about=$request->about;
        $user->save();

        session()->flash('success','User Updated Successfully');
        return redirect()->route('users.index');

    }
}
