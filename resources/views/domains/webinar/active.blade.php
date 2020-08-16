<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-12">
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
            @if($webinar->diff >= -300)
                <chat :user="{{ auth()->user() }}" webinar="{{ $webinar->id }}"></chat>
            @else
                <p>Czat zostanie uruchomiony 5 minut przed webinarem.</p>
            @endif
        </div>
    </div>
</div>