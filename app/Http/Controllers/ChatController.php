<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Chat::with('user')->get();
        return response()->json(['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message = Chat::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => $message]);
    }
}
