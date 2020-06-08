<?php
namespace App\Domains\Webinar\Controllers;

use App\Domains\Webinar\Models\Webinar;
use App\Domains\Webinar\Repositories\WebinarSubscriptionRepository;
use App\Domains\Webinar\Requests\SubscribeRequest;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $webinar->update([
            'scheduled_at' => Carbon::now()->addMinutes(rand(1, 100)),
        ]);

        return view('domains.webinar.webinar')->with(compact('webinar'));
    }

    public function subscribe(
        Webinar $webinar,
        SubscribeRequest $request,
        UsersRepository $usersRepository,
        WebinarSubscriptionRepository $subscriptionRepository
    ) {
        $user = $usersRepository->firstOrCreate($request->input('name'), $request->input('email'));

        Auth::login($user);

        $subscriptionRepository->subscribe($user, $webinar);

        flash('Zapisano poprawnie');

        return back();
    }
}