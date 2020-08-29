<?php
namespace App\Domains\Chat\Transformers;

use App\Domains\Chat\Models\Message;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    public function transform(Message $message) : array
    {
        return [
            'id'        => $message->id,
            'name'      => $message->user->name,
            'message'   => $message->message,
            'timestamp' => $message->created_at,
            'is_admin'  => $message->user->is_admin,
        ];
    }
}
