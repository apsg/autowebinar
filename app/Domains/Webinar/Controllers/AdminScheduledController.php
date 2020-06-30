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

    public function import(Webinar $webinar)
    {
        $csv = array_map('str_getcsv', file(request()->file('file')->getPathname()));

        $counter = 0;
        foreach ($csv as $row) {
            try {
                $data = explode(';', $row[0]);

                $webinar->scheduled_messages()->create([
                    'time'    => $data[0],
                    'name'    => $data[1],
                    'message' => $data[2],
                ]);
                $counter++;
            } catch (\Exception $exception) {
                // ignore
            }
        }

        flash("Zaimportowano {$counter} wiadomości");

        return back();
    }
}
