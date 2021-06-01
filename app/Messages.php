<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{

    protected $table = 'messages';

    public $timestamps = false;

    protected $fillable = [
        'thread_id',
        'sender_id',
        'body',
        'created_at'
    ];

    public $dates = ['created_at'];

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function thread()
    {
        return $this->belongsTo('MessageThread', 'thread_id');
    }

}
