<?php

use Illuminate\Http\Request;
Use App\Note;
Use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// LOGIN
Route::post('/login', function(Request $request) {
    // create our user data for the authentication
    $userdata = array(
        'email'     => $request->email,
        'password'  => $request->password
    );
    // attempt to do the login
    if (Auth::attempt($userdata)) {
        // return redirect()->route('home');
        return Auth::user()->generateToken();
    } else {        
        return "Login Failed";
    }
});

// Get user information
Route::post('/user', function(Request $request) {
    if (isset($request->api_token)) {
        $api_token = $request->api_token;
        $record = \DB::table('users')->where('api_token', $api_token)->first();
        if (count($record) > 0) {
            $user = new stdClass();
            $user->name = $record->name;
            $user->email = $record->email;
            $user->created_at = $record->created_at;
            $user->updated_at = $record->updated_at;
            return json_encode($user);
        }
        else {
            return "Access Denied";
        }
    }
    else {
        return "Access Denied";
    }
    return False;
});
