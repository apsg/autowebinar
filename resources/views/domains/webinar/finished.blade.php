<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <v-video
                    link="{{ $webinar->video }}"
                    time="{{ $webinar->diff }}"
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