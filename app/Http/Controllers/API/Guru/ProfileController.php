<?php

namespace App\Http\Controllers\API\Guru;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Auth;
use Image;

class ProfileController extends Controller
{
    //edit profile guru
    public function update_avatar(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('upload/avatar/' . $filename));

            $user -> avatar = $filename;
            $user ->save();
        }
    }
}
