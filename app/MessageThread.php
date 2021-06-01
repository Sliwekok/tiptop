<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MessageThread extends Model
{

    protected $table = 'message_threads';

    public $timestamps = false;

    public $dates = ['last_read', 'deleted_at'];

    protected $with = ['messages'];

    public function messages()
    {
        return $this->hasMany('App\Messages', 'thread_id');
    }

    public function users()
    {
        return $this->hasMany('App\MessageThreadUsers', 'thread_id');
    }

    public function getLastMessageAttribute()
    {
        return $this->messages->sortBy('created_at')->last();
    }

    public function getRecipientDeletedAttribute()
    {
        return $this->users()->where('user_id', '!=', Auth::user()->id)->where('deleted_at', '!=', null)->exists();
    }

}
