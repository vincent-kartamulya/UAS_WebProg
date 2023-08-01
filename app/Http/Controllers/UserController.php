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
        $price = rand(100000, 125000);
        $validated = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'hobbies' => 'required|string|max:1000|regex:/^([^\n]*\n){3,}[^\n]*$/',
            'instagramUsername' => 'required|/^https:\/\/www\.instagram\.com\/[a-zA-Z0-9_]+\/$/',
            'gender' => 'required|in:male,female',
            'phoneNumber' => 'required|regex:/^[0-9]{10,14}$/',
            'image' => 'required|image',
            'password' => 'required|string|min:8',
        ]);

        $validated['image']  = $request->file('image')->store('profile');

        $user = User::create([
            'name' => $validated['name'],
            'hobbies' => $validated['hobbies'],
            'instagramUsername' => $validated['instagramUsername'],
            'gender' => $validated['gender'],
            'phoneNumber' => $validated['phoneNumber'],
            'imagePath' => $validated['image'],
            'password' => Hash::make($validated['password']),
            'wallet' => $price
        ]);

        return view('payment', compact('user'));
    }

    public function payment(Request $request){
    $user = auth()->user()->id;
    $amount = $request->amount;

    if ($amount < $user->registrationPrice) {
        // User underpaid, store the warning message in the session
        $underpaidAmount = $user->registrationPrice - $amount;
        return redirect()->back()->with('underpaid', "You are still underpaid $underpaidAmount");
    } elseif ($amount > $user->registrationPrice) {
        // User overpaid, store the message in the session
        $overpaidAmount = $amount - $user->registrationPrice;
        return redirect()->back()->with('overpaid', "Sorry you overpaid $overpaidAmount, would you like to enter a into balance?");
    } else{

    }

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
