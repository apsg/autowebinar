<?php
namespace App\Domains\Webinar\Controllers;

use App\Http\Controllers\Controller;

class WebinarController extends Controller
{
    public function show()
    {
        return view('domains.webinar.webinar');
    }
}