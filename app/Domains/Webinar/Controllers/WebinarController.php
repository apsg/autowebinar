<?php
namespace App\Domains\Webinar\Controllers;

use App\Domains\Webinar\Models\Webinar;
use App\Http\Controllers\Controller;

class WebinarController extends Controller
{
    public function show(Webinar $webinar)
    {
        return view('domains.webinar.webinar')->with(compact('webinar'));
    }
}