<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    public function shared_users() {
        return $this->belongsToMany('App\User', 'access_rights', 'note_id', 'user_id');
    }
}
