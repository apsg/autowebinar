<?php

namespace App\Domains\Webinar\Controllers;

use App\Domains\Webinar\Models\Webinar;
use App\Domains\Webinar\Requests\WebinarEditRequest;
use App\Http\Controllers\Controller;

class AdminWebinarsController extends Controller
{
    public function index()
    {
        $webinars = Webinar::orderBy('scheduled_at')->get();

        return view('domains.webinar.admin.index')->with(compact('webinars'));
    }

    public function create()
    {
        return view('domains.webinar.admin.create');
    }

    public function store(WebinarEditRequest $request)
    {
        Webinar::create($request->all());

        flash('Dodano pomyślnie');

        return redirect(route('admin.webinar.index'));
    }

    public function edit(Webinar $webinar)
    {
        return view('domains.webinar.admin.edit')->with(compact('webinar'));
    }

    public function patch(Webinar $webinar, WebinarEditRequest $request)
    {
        $webinar->update($request->all());

        flash('Zapisano');

        return back();
    }

    public function destroy(Webinar $webinar)
    {
        $webinar->delete();

        flash('Webinar usunięty');

        return redirect(route('admin.webinar.index'));
    }

    public function deleteMessages(Webinar $webinar)
    {
        $webinar->messages()->delete();

        flash('Usunięto wiadomości');

        return back();
    }
}
