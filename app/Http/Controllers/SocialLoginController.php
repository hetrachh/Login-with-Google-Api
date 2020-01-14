<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Exception;

class SocialLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $existsUser = User::where('email',$user->email)->first();

        try{
            if($existsUser)
            {
                Auth::loginUsingId($existsUser->id);
            }
            else{
                $users = new User;
                $users->name = $user->name;
                $users->email = $user->email;
                $users->google_id = $user->id;
                $users->password = md5(rand(1,10000));
                $s = $users->save();
                //echo $s;
                Auth::loginUsingId($users->id);
            }

            return redirect()->to('/home');
        }
        catch (Exception $e){
            return 'error';
        }

    }
}
