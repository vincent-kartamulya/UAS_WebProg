<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Love;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeddingController extends Controller
{
    public function home(){
        $user = Auth::user();
        $partnerId = $user->gender == "male" ? substr_replace($user->id, "2", -1) : substr_replace($user->id, "1", -1);
        $partner = User::find($partnerId);
        // ddd($user->gender);
        if(!$partner){
            if($user->gender == "male"){
                $candidate = User::where('gender', 'female')->get();
            }else{
                $candidate = User::where('gender', 'male')->get();
            }
        }
        return view("home",[
            'candidate'=>$candidate
        ]);
    }
    public function showAll($location=null){
        $user = Auth::user();

        $partnerId = $user->gender == "male" ? substr_replace($user->id, "2", -1) : substr_replace($user->id, "1", -1);
        $partner = User::find($partnerId);
        if(!$partner){
            $partner = User::find(Like::where('user_id', $user->id)->where('status', 2)->pluck('liked_user_id')->first());
            if(!$partner){
                $partner = User::find(Like::where('liked_user_id', $user->id)->where('status', 2)->pluck('user_id')->first());
            }
        }

        $vendors = Wedding::all();

        if($location==null){
            $vendors = Wedding::paginate(10);

        }else{
            $vendors = Wedding::where('location',$location)->paginate(10);
        }
        return view("wedding",[
            'vendors'=>$vendors,
            'partner'=>$partner
        ]);
    }

    public function checkLike(Request $request, $candidateId)
    {
        // Get the ID of the current user.
        $currentUserId = auth()->user()->id;
        ddd($currentUserId);
        // Check if the current user has already liked the candidate.
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
        // Return the result as a JSON response.
        return response()->json(['hasLiked' => $hasLiked]);
    }

    public function checkOut($id){
        $vendor = Wedding::findOrFail($id);
        return view('checkout',['vendor' => $vendor]);
    }
    public function storeCheckOut(Request $request){
        $vendor = Wedding::findOrFail($request->id);
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'place' => $vendor->vendor,
            'date' => $request->date,
            'price' => $vendor->price,
            'address' => $vendor->address,
            'payment' => $request->payment,
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        $user->money = $user->money - $request->price;
        $user->update();

        return redirect('/wedding');
    }
}
