<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function home(){
        $user = Auth::user();
        $friends = User::all();
        return view("home",[
            'friends' => $friends
        ]);
    }

    public function search(Request $request){
        $query = $request->input('query');
        $gender = $request->input('gender');

        $usersQuery = User::all();

        // Apply gender filter if selected
        if ($gender && in_array($gender, ['Male', 'Female'])) {
            $usersQuery->where('gender', $gender);
        }

        // Apply search query filter
        if ($query) {
            $friends = $usersQuery->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('hobbies', 'like', '%' . $query . '%')->get();
            });
        }

        return view('search', ['friends' => $friends]);
    }

    public function checkLike(Request $request, $candidateId)
    {
        $currentUserId = auth()->user()->id;

        $hasLiked = Like::where('user_id', $candidateId)
                        ->where('liked_user_id', $currentUserId)
                        ->exists();
        $hasLikedOpp = Like::where('user_id', $currentUserId)
                        ->where('liked_user_id', $candidateId)
                        ->exists();
        if($hasLikedOpp) return;

        if(!$hasLiked){
            $like = Like::create([
                'user_id' => $currentUserId,
                'liked_user_id'=> $candidateId,
                'status' => 1
            ]);
        }else{
            $like = Like::where('user_id', $candidateId)
                    ->where('liked_user_id', $currentUserId)->first();
            $like->status = 2;
            $like->update();
        }

        return response()->json(['hasLiked' => $hasLiked]);
    }
}
