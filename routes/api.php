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
Route::post('/user', function(Request $request) {
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

// Route::get('/user', function(Request $request) {
//     dd($request);
//     return "TEST";
// });
