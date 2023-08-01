<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(){
        $users = User::all();
        return view('dashboard', compact('users'));
    }
    public function edit(Request $request){
        $user = User::findOrFail($request->userId);
        $user->name = $request->name;
        $user->phoneNumber = $request->phoneNumber;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->save();

        return redirect('/dashboard');
    }
    public function changeBanned(Request $request){
        $user = User::findOrFail($request->id);
        if($user->banned == 1){
            $user->banned = 0;
        }else{
            $user->banned = 1;
        }
        $user->save();

        return redirect('/dashboard');
    }
}
