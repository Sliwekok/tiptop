<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageThreadUsers extends Model
{

    protected $table = 'message_thread_users';

    protected $fillable = [
        'thread_id',
        'user_id',
    ];

    public $dates = ['deleted_at'];
    public $timestamps = false;

    public function thread()
    {
        return $this->belongsTo('App\MessageThread');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
