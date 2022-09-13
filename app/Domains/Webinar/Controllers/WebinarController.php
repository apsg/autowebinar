<?php

namespace App\Domains\Webinar\Controllers;

use App\Domains\Webinar\Models\Webinar;
use App\Domains\Webinar\Repositories\WebinarSubscriptionRepository;
use App\Domains\Webinar\Requests\SubscribeRequest;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

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
//        if (! app()->environment('production')) {
//            $webinar->update([
//                'scheduled_at' => Carbon::now()->subSeconds(1),
//            ]);
//        }

        return view('domains.webinar.webinar')->with(compact('webinar'));
    }

    public function subscribe(
        Webinar $webinar,
        SubscribeRequest $request,
        UsersRepository $usersRepository,
        WebinarSubscriptionRepository $subscriptionRepository
    ) {
        $user = $usersRepository->firstOrCreate($request->input('name'), $request->input('email'));

        if ($user->isAdmin()) {
            throw new UnauthorizedException();
        }

        Auth::login($user);

        $subscriptionRepository->subscribe($user, $webinar);

        return redirect(route('webinar.show', $webinar));
    }

    public function login(Webinar $webinar, string $token, UsersRepository $repository)
    {
        try {
            $user = $repository->findByToken($token);
        } catch (ModelNotFoundException $exception) {
            flash()->error('Przepraszamy, błędny token logowania lub konto nie istnieje');

            return redirect('/');
        }

        if (!$user->isSubscribed($webinar)) {
            flash()->error('Nie zapisano Cię na ten webinar!');

            return redirect('/');
        }

        Auth::login($user);
        $repository->clearLoginToken($user);

        return redirect(route('webinar.show', $webinar));
    }

    public function presence(Webinar $webinar, WebinarSubscriptionRepository $repository)
    {
        if (Auth::guest()) {
            return response('Not logged in', 403);
        }

        $repository->presence(Auth::user(), $webinar);

        return response('ok');
    }
}
