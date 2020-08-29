<div class="container-fluid p-3">
    <div class="row bg-white rounded-right-big rounded-left-big p-3">
        <div class="col-md-9 col-sm-12">
            <h3 class="font-weight-bold font-20">
                <img src="{{ asset('/images/live-kropka.png') }}" style="height: 1em;" />
                {{ $webinar->name }}
            </h3>
            <hr />
        </div>
        <div class="col-md-9 col-sm-12" style="position: relative">
            @foreach($webinar->ctas as $cta)
                <cta delay="{{ $cta->delay }}"
                     duration="{{ $cta->duration }}"
                     title="{{ $cta->title }}"
                     description="{{ $cta->description }}"
                     button_url="{{ $cta->button_url }}"
                     button_text="{{ $cta->button_text }}"
                ></cta>
            @endforeach
            <v-video
                    link="{{ $webinar->video }}"
                    time="{{ $webinar->current_time }}"
                    start="{{ $webinar->scheduled_at }}"
            ></v-video>
        </div>
        <div class="col-md-3 col-sm-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Czat
                        <span class="icon"><i class="fa fa-comment"></i> </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Pliki
                        <span class="icon"><i class="fa fa-download"></i> </span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <chat :user="{{ auth()->user() }}" webinar="{{ $webinar->id }}"></chat>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            </div>
        </div>
    </div>
</div>