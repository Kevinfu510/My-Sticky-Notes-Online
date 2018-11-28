<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Note;
use App\User;

class NoteController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('index');
    }

    public function create() {
        if (Auth::check()) {
        // The user is logged in...
            return view('notes.create');
        }
        else {
            return view('index');
        }
    }

    public function store(Request $request) {
        if (Auth::check()) {
            // The user is logged in...
            $note = new Note;
            $note->user_id = Auth::id();
            $note->title = Input::get('name');
            $note->content = Input::get('content');
            $note->date_created = Carbon::now();
            $note->date_modified = Carbon::now();
            $note->save();
            return redirect()->route('home');
        }
        else {
            return view('index');
        }
    }

    public function show(Request $request, $note) {
        if (Auth::check()) {
            $record = \DB::table('notes')->where('id', $note)->first();
            $note_record = Note::find($note);
            $user_ids = $note_record->shared_users()->pluck('user_id')->toArray();
            if ($record->user_id == Auth::id() or in_array(Auth::id(), $user_ids)){
                $shared_users = $note_record->shared_users()->get();
                return view('notes.index', ['data' => $record, 'share_data' => $shared_users]);
            }
        }
        else {
            return view('index');
        }
    }

    public function edit(Request $request, $note) {
        if (Auth::check()) {
            $record = \DB::table('notes')->where('id', $note)->first();
            $note_record = Note::find($note);
            $shared_users = $note_record->shared_users()->get();
            return view('notes.edit', ['data' => $record, 'share_data' => $shared_users]);
        }
        else {
            return view('index');
        }
    }

    public function update(Request $request, $note) {
        $customNames = [];

        $rules = [
            'title' => 'required',
            'content' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($customNames);

        $record = Note::find($note);
        $record->title = $request->name;
        $record->content = $request->content;
        $record->date_modified = Carbon::now();

        $record->save();
        return redirect()->route('home');

    }

    public function delete(Request $request, $note) {
        if (Auth::check()) {
            $record = Note::where('id', $note);
            $record->delete();
            return redirect()->route('home');
        }
        else {
            return view('index');
        }
    }

    public function share(Request $request, $note) {
        if (Auth::check()) {
            $username = Input::get('username');
            $user_record = \DB::table('users')->where('name', $username)->first();
            if ($user_record != null) {
                $user = User::find($user_record->id);
                $note_record = Note::find($note);
                if (! $user->shared_notes->contains($note)) {
                    $user->shared_notes()->attach($note);
                    $record = \DB::table('notes')->where('id', $note)->first();
                    $shared_users = $note_record->shared_users()->get();
                    return redirect()->route('notes.edit', ['id' => $note]);

                    // return view('notes.edit', ['data' => $record, 'share_data' => $shared_users]);
                }
                else {
                    $record = \DB::table('notes')->where('id', $note)->first();
                    $shared_users = $note_record->shared_users()->get();
                    return view('notes.edit', ['data' => $record, 'error' => 'Already shared to user '. $username .'!', 'share_data' => $shared_users]);
                }
            }
            else {
                $record = \DB::table('notes')->where('id', $note)->first();
                $note_record = Note::find($note);
                $shared_users = $note_record->shared_users()->get();
                return view('notes.edit', ['data' => $record, 'error' => 'No User named "'. $username .'" exists!', 'share_data' => $shared_users]);
            }

        }
        else {
            return view('index');
        }   
    }

    public function remove(Request $request, $note, $user_id) {
        if (Auth::check()) {
            $note_record = Note::find($note);
            $note_record->shared_users()->detach($user_id);
            // $record = \DB::table('notes')->where('id', $note)->first();
            // $note_record = Note::find($note);
            // $shared_users = $note_record->shared_users()->get();
            return redirect()->route('notes.edit', ['id' => $note]);

        }
        else {
            return view('index');
        }   
    }


}
