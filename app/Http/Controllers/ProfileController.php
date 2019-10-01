<?php

namespace App\Http\Controllers;

use App\Profile;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = Profile::where('user_id',auth()->user()->id)->first();

        return Inertia::render('Profile/Index', compact('user','profile'));
    }

    public function store(Request $request)
    {
        $userProfile = Profile::where('user_id',auth()->user()->id)->exists();
        if($userProfile){
            $userProf = Profile::where('user_id',auth()->user()->id)->first();
            
            $userProf->bio = $request->bio;
            $userProf->url = $request->url;
            $userProf->location = $request->location;

            $userProf->save();
     
        }else{
            Profile::create([
                'user_id' => auth()->user()->id,
                'url' => $request->bio,
                'bio' => $request->url,
                'location' => $request->location
            ]);

        }
        session()->flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
       $this->validate($request, [
        'current_password'=>'required',
        'password' => 'required|min:6|confirmed'
       ]);

       $user = auth()->user();

       if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success', 'Password Updated Successfully!');
            return redirect()->back();
       }else{
           return response([
               'status'=>'error',
               'Message'=>'Password cannot be updated'
           ]);
       }
    
    }
}
