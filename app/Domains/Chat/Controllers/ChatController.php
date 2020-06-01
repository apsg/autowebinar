<?php
namespace App\Domains\Chat\Controllers;

use App\Domains\Chat\Events\MessageSentEvent;
use App\Domains\Chat\Models\Message;
use App\Events\OrderTest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('domains.chat.index');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSentEvent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}