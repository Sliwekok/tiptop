<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id', 'messages_notifications', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function threads()
    {
        return $this->belongsToMany('App\MessageThread', 'message_thread_users', 'user_id', 'thread_id')->where('message_thread_users.deleted_at', '=', null);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function getUnreadMessagesCountAttribute()
    {

        $count = 0;

        $this->threads()->withCount(['messages as unread_messages_count' => function ($query) {
            $query->where('sender_id', '!=', $this->id)->whereRaw('created_at >= message_thread_users.last_read');
        }])->chunk(200, function ($threads) use (&$count) {
            $count += $threads->sum('unread_messages_count');
        });

        return $count;

    }

    public function markThreadAsRead($threadId)
    {
        $this->threads()->updateExistingPivot($threadId, [
            'last_read' => $this->freshTimestamp()
        ]);
    }

    public function animalsNotifications()
    {
        return $this->hasMany('App\UserAnimalsNotifications', 'id_user', 'id');
    }

}
