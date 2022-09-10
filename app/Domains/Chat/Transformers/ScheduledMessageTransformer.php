<?php
namespace App\Domains\Chat\Transformers;

use App\Domains\Chat\Models\ScheduledMessage;
use League\Fractal\TransformerAbstract;

class ScheduledMessageTransformer extends TransformerAbstract
{
    public function transform(ScheduledMessage $message): array
    {
        return [
            'id'        => $message->id,
            'name'      => $message->name,
            'message'   => $message->message,
            'timestamp' => $message->scheduled_at,
            'time'      => $message->time,
        ];
    }
}
