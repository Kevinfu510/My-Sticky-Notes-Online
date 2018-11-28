<?php
use Illuminate\Support\Facades\Auth;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return redirect('/');
    if (Auth::check()) {
        $notes = DB::table('notes')->where('user_id', Auth::id())->get();
        // $notes = DB::table('notes')->where('user_id', Auth::id())->get();
        $user = User::find(Auth::id());
        $shared_notes = $user->shared_notes()->get();
        // return view('index')->with('records', $notes);
        return view('index', ['records' => $notes, 'shared_records' => $shared_notes]);

    }
    else {
        return view('index');
    }

})->name('home');

Auth::routes();

// LOGIN
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@post')->name('doLogin');

// REGISTER
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@post')->name('doRegister');

// NOTES
Route::get('/notes/create', 'NoteController@create')->name('notes.create');
Route::post('/notes/create', 'NoteController@store')->name('notes.store');

Route::get('/notes/{id}', 'NoteController@show')->name('notes.show');

Route::get('/notes/{id}/edit', 'NoteController@edit')->name('notes.edit');
Route::post('/notes/{id}/update', 'NoteController@update')->name('notes.update');
Route::post('/notes/{id}/share', 'NoteController@share')->name('notes.share');
Route::delete('/notes/{id}/remove/{user_id}', 'NoteController@remove')->name('notes.remove');

Route::delete('/notes/{id}/delete', 'NoteController@delete')->name('notes.delete');
