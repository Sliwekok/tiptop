<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class GlobalComposer
{
    public function compose(View $view)
    {

        $unreadMessages = 0;

        if(Auth::check()) {
            $unreadMessages = Auth::user()->unread_messages_count;
        }

        $view->with('unreadMessages', $unreadMessages);
    }
}