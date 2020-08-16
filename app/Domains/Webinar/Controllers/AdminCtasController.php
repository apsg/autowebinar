<?php
namespace App\Domains\Webinar\Controllers;

use App\Domains\Webinar\Models\CallToAction;
use App\Domains\Webinar\Requests\CreateCtaRequest;
use App\Http\Controllers\Controller;

class AdminCtasController extends Controller
{
    public function store(CreateCtaRequest $request)
    {
        CallToAction::create($request->all());

        flash('Dodano');

        return back();
    }

    public function destroy(CallToAction $cta)
    {
        $cta->delete();

        flash('Usunięto wezwanie do działania');

        return back();
    }
}