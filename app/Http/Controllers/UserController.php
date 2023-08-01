<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function storeLogin(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->banned == 1) {
                return redirect()->back()->with('error', "You are banned from this server");
            }else if($user->role == 'admin'){
                return redirect('/dashboard');
            }else if($user->role == 'user'){
                return redirect('/');
            }
        }

        return redirect()->back()->with('error', "Email atau password salah");
    }

    public function getLogin()
    {
        return view('login');
    }

    public function getRegister()
    {
        return view('register');
    }

    public function storeRegister(Request $request)
    {
        $genderCode = $request->gender == "male" ? "01" : "02";
        $id = "SKY" . $request->datingCode . $genderCode;
        $request->merge(['id' => $id]);

        $validated = $request->validate([
            'id' => 'unique:users',
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|unique:users',
            'datingCode' => 'required|regex:/^[0-9]{3}$/',
            'birthdate' => 'required|date',
            'gender' => 'required|in:male,female',
            'phoneNumber' => 'required|regex:/^[0-9]{10,14}$/',
            'image' => 'required|image',
            'password' => 'required|string|min:8',
            'passwordConfirmation' => 'required|string',
        ]);

        $validated['image']  = $request->file('image')->store('profile');

        $user = User::create([
            'id' => $id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'datingCode' => "DT" . $validated['datingCode'],
            'birthdate' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'phoneNumber' => "+65" . $validated['phoneNumber'],
            'imagePath' => $validated['image'],
            'password' => Hash::make($validated['password']),
            'banned' => 0
        ]);

        return redirect("/login")->with('success', 'Selamat akun anda berhasil dibuat, anda dapat login menggunakan ' . $validated['email'] . ' atau ' . $id);
    }

    public function createLogin()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
