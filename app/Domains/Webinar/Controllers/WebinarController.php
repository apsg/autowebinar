<?php
namespace App\Domains\Webinar\Controllers;

use App\Domains\Webinar\Models\Webinar;
use App\Http\Controllers\Controller;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::future()
            ->orderBy('scheduled_at')
            ->get();

        return view('domains.webinar.index')->with(compact('webinars'));
    }

    public function show(Webinar $webinar)
    {
        return view('domains.webinar.webinar')->with(compact('webinar'));
    }
}