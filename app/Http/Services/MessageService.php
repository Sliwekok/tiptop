<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.05.2018
 * Time: 15:07
 */

namespace App\Http\Services;

use App\Exceptions\CantMessageInThread;
use App\Exceptions\CantMessageYourself;
use App\Exceptions\RecipientRemoveThisMessage;
use App\Mail\NewMessage;
use App\MessageThread;
use App\User;
use Carbon\Carbon;
use Debugbar;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MessageService
{

    /**
     * @param $title string
     * @param $fromUserId int
     * @param $toUserId int
     * @return MessageThread
     */
    private function createThread($title, $fromUserId, $toUserId): MessageThread
    {

        return DB::transaction(function () use ($title, $fromUserId, $toUserId) {

            $thread = new MessageThread();
            $thread->title = $title;
            $thread->save();

            $lastRead = Carbon::now();

            $users = [
                [
                    'thread_id' => $thread->id,
                    'user_id' => $fromUserId,
                    'last_read' => $lastRead
                ],
                [
                    'thread_id' => $thread->id,
                    'user_id' => $toUserId,
                    'last_read' => $lastRead
                ]
            ];

            $thread->users()->insert($users);

            return $thread;

        });

    }

    /**
     * @param array $users
     * @return mixed
     */
    private function usersThreadScope($users = [])
    {
        return MessageThread::whereHas('users', function ($query) use ($users) {
            $query->select('thread_id')->whereIn('user_id', $users);
        });
    }

    /**
     * @param $toUserId int|null
     * @param $message string
     * @param $title null|string
     * @param $threadId null|int
     * @return bool
     * @throws Exception
     */
    public function sendMessage($toUserId = null, $message, $title = null, $threadId = null)
    {

        try {

            $fromUserId = Auth::user()->id;

            if ($fromUserId === $toUserId) {
                throw new CantMessageYourself();
            }

            if ($threadId == null) {
                $thread = $this->createThread($title, $fromUserId, $toUserId);
            } else {
                $thread = MessageThread::where('id', '=', $threadId)->first();
            }

            if (!$this->usersThreadScope([$toUserId, $fromUserId])->exists()) {
                throw new CantMessageInThread();
            }

            if ($thread->getRecipientDeletedAttribute()) {
                throw new RecipientRemoveThisMessage();
            }

            $thread->messages()->insert([
                'body' => $message,
                'sender_id' => $fromUserId,
                'thread_id' => $thread->id,
                'created_at' => Carbon::now()
            ]);

            /*
             * Send email with new message notification.
             */

            if ($toUserId == null) {

                $users = $thread->users()->get();

                foreach ($users as $user) {
                    if ($user->user_id != $fromUserId) {
                        $toUserId = $user->user_id;
                    }
                }

            }

            $user = User::where('id', '=', $toUserId)->first();

            if (!$user->isOnline() && $user->notifications) {
                Mail::to($user)->queue(new NewMessage($thread->title, $user->name));
            }

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $threadId
     * @return array
     */
    public function getMessages($threadId)
    {

        $thread = MessageThread::where('id', '=', $threadId)->first();

        Auth::user()->markThreadAsRead($threadId);

        return [
            'title' => $thread->title,
            'messages' => $thread->messages()->get(),
            'recipientDeleted' => $thread->recipientDeleted
        ];

    }

}