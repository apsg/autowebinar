<?php
namespace App\Domains\Webinar\Controllers;

use App\Domains\Chat\Models\ScheduledMessage;
use App\Domains\Webinar\Models\Webinar;
use App\Domains\Webinar\Requests\ScheduledMessageRequest;
use App\Http\Controllers\Controller;

class AdminScheduledController extends Controller
{
    public function store(Webinar $webinar, ScheduledMessageRequest $request)
    {
        $webinar->scheduled_messages()->create($request->all());

        return back();
    }

    public function destroy(Webinar $webinar, ScheduledMessage $message)
    {
        $message->delete();

        return back();
    }
}