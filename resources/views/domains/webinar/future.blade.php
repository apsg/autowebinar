<div class="container">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <h2 class="text-center">{{ $webinar->name }}</h2>
                <hr/>
                <div class="d-flex justify-content-around">
                    <div class="d-flex">
                        <div><i class="fa fa-4x fa-calendar color-second"></i></div>
                        <div class="pl-3">
                            Data: <br/>
                            <span class="font-weight-bold">{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw')->format('Y-m-d') }}</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div><i class="fa fa-4x fa-clock-o color-second"></i></div>
                        <div class="pl-3">
                            Czas: <br/>
                            <span class="font-weight-bold">{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw')->format('H:i') }} (Europe/Warsaw)</span>
                        </div>
                    </div>
                </div>
                <hr/>
                <div>
                    <h5>
                        <i class="fa fa-list color-second"></i> Opis wydarzenia
                    </h5>
                    <p>{!! nl2br($webinar->description) !!}</p>
                </div>
                <hr/>
                @if($webinar->hasPresenter())
                    <h5><i class="fa fa-user color-second"></i> Prowadzący </h5>
                    <div class="d-flex">
                        @if($webinar->presenter_description)
                            <div class="p-1" style="flex:1;">
                                @markdown($webinar->presenter_description)
                            </div>
                        @endif
                        @if($webinar->presenter_url)
                            <div class="p-1"  style="flex:1;">
                                <img src="{{ $webinar->presenter_url }}" class="w-100">
                            </div>
                        @endif
                    </div>
                @endif
                <hr/>
                <div class="text-center">
                    <p>Webinar rozpocznie się za:</p>
                    <timer
                            starttime="{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}"
                            endtime="{{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}"
                    ></timer>
                </div>
            </div>
        </div>
    </div>
</div>