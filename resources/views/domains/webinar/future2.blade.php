<div class="mobile-hide">
    <div class="d-flex justify-content-center mt-5 color-white">
        <div class="d-flex align-items-stretch">
            <div class="p-3 d-flex flex-column align-content-center justify-content-center">
                <div>
                    <div class="font-25 lh-50 color-light-blue font-weight-bold font-family-din" title="Data">
                        <img class="h-40p" src="{{ asset('images/ikonka-kalendarz.png') }}"/>
                        {{ $webinar->scheduled_at->format('Y-m-d') }}
                    </div>
                    <div class="font-25 lh-50 color-light-blue font-weight-bold font-family-din" title="Czas">
                        <img class="h-40p" src="{{ asset('images/ikonka-zegar.png') }}"/>
                        {{ $webinar->scheduled_at->format('H:i') }} (GMT{{ $webinar->scheduled_at->format('O') }})
                    </div>
                </div>
            </div>
            <div class="bg-light-blue px-5 py-5 rounded-left-big flex-grow-1">
                <div class="d-flex flex-column justify-content-between h-100">
                    <div>
                        <h1 class="font-60 lh-1 font-family-ssp font-weight-bold">{{ $webinar->name }}</h1>
                        <h5 class="color-dark-blue mt-3 font-30 font-family-din">Plan spotkania:</h5>
                        <p class="font-20 font-family-din lh-1p2">{!! nl2br($webinar->description) !!}</p>
                    </div>
                    <div class="text-center">
                        <h3 class="font-20 font-weight-bold color-dark-blue">Webinar rozpocznie się za:</h3>
                        <timer
                                starttime="{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}"
                                endtime="{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}"
                        ></timer>
                    </div>
                </div>
            </div>
            <div class="px-3 py-5 bg-white rounded-right-big d-flex flex-column align-content-center justify-content-center">
                <div class="text-center">
                    <h3 class="font-family-din font-25 color-dark-blue">Prowadzący:</h3>
                    <img src="{{ $webinar->presenter_url ?? asset('/images/mati.png') }}">
                    <div class="mt-3 font-family-din font-30 font-weight-bold color-yellow lh-1">
                        @markdown($webinar->presenter_description)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mobile-show container">
    <div class="row color-white">
        <div class="col-xs-12 col-md-6 bg-white">
            <div class="font-25 lh-50 color-light-blue font-weight-bold font-family-din" title="Data">
                <img class="h-40p" src="{{ asset('images/ikonka-kalendarz.png') }}"/>
                {{ $webinar->scheduled_at->format('Y-m-d') }}
            </div>
        </div>
        <div class="col-xs-12 col-md-6 bg-white">
            <div class="font-25 lh-50 color-light-blue font-weight-bold font-family-din" title="Czas">
                <img class="h-40p" src="{{ asset('images/ikonka-zegar.png') }}"/>
                {{ $webinar->scheduled_at->format('H:i') }} (GMT{{ $webinar->scheduled_at->format('O') }})
            </div>

        </div>
        <div class="bg-light-blue rounded-lg w-100 container py-5">
            <div class="d-flex flex-column justify-content-between h-100">
                <div>
                    <h1 class="font-60 lh-1 font-family-ssp font-weight-bold text-white">{{ $webinar->name }}</h1>
                    <h5 class="color-dark-blue mt-3 font-30 font-family-din">Plan spotkania:</h5>
                    <p class="font-20 font-family-din lh-1p2">{!! nl2br($webinar->description) !!}</p>
                </div>
                <div class="text-center">
                    <h3 class="font-20 font-weight-bold color-dark-blue">Webinar rozpocznie się za:</h3>
                    <timer
                            starttime="{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}"
                            endtime="{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}"
                    ></timer>
                </div>
            </div>
        </div>
        <div class="d-flex align-content-center justify-content-center w-100 bg-white">
            <div class="text-center">
                <h3 class="font-family-din font-25 color-dark-blue">Prowadzący:</h3>
                <img src="{{ $webinar->presenter_url ?? asset('/images/mati.png') }}">
                <div class="mt-3 font-family-din font-30 font-weight-bold color-yellow lh-1">
                    @markdown($webinar->presenter_description)
                </div>
            </div>
        </div>
    </div>
</div>
