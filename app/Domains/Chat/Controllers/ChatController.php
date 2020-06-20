<?php

namespace App\Domains\Chat\Controllers;

use App\Domains\Chat\Events\MessageSentEvent;
use App\Domains\Chat\Models\Message;
use App\Domains\Chat\Transformers\ScheduledMessageTransformer;
use App\Domains\Webinar\Models\Webinar;
use App\Helpers\FractalHelper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Webinar $webinar)
    {
        return view('domains.chat.index');
    }

    public function fetchMessages(Webinar $webinar)
    {
        $messages = $webinar->all_messages;
        $scheduled = FractalHelper::toArray(
            $webinar->scheduled_future_messages,
            new ScheduledMessageTransformer()
        );
        $time = $webinar->current_time;

        return compact('messages', 'scheduled', 'time');
    }

    public function sendMessage(Webinar $webinar, Request $request)
    {
        if (! $webinar->isChatEnabled()) {
            return response()->json(['status' => 'Webinar ended'], 401);
        }

        /** @var User $user */
        $user = Auth::user();

        /** @var Message $message */
        $message = $user->messages()->create([
            'message'    => $request->input('message'),
            'webinar_id' => $webinar->id,
        ]);

        broadcast(new MessageSentEvent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
