<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginWithGoogleController extends Controller {
    public function redirectToGoogle() {
        $url =  Socialite::driver( 'google' )->redirect();
        return  Inertia::location( $url );
    }

    public function handleGoogleCallback() {
        try {

            $user = Socialite::driver( 'google' )->user();
            // dd($user);
            $finduser = User::where( 'google_id', $user->id )->first();

            if ( $finduser ) {
                Auth::login( $finduser );
                return redirect()->intended( 'dashboard' );

            } else {
                $var = explode( ' ', $user->name );

                $newUser = User::create( [
                    'firstname' => $var[ 0 ],
                    'lastname' => $var[ 1 ],
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'profile_photo_url' => $user->picture,
                    'password' => Hash::make( '123456dummy' ),
                ] );
                Auth::login( $newUser );

                return redirect()->intended( 'dashboard' );
            }

        } catch ( Exception $e ) {
            dd( $e->getMessage() );
        }
    }
}
