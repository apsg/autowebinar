<div class="container">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-header">
                <h4 class="text-center">Zapisz się na ten webinar</h4>
            </div>
            @if(Auth::check() && Auth::user()->isSubscribed($webinar))
                <div class="card-body">
                    <p>Mamy już Twoje zgłoszenie na ten webinar!
                        Kilka minut przed jego rozpoczęciem dostaniesz maila z adresem dostępowym.
                        Do zobaczenia!
                    </p>
                </div>
            @else
                <div class="card-body">
                    <form action="{{ route('webinar.subscribe', $webinar) }}" method="post">
                        @csrf
                        <div class="form-group text-center">
                            <label class="">Imię
                                <input class="form-control"
                                       type="text"
                                       name="name"
                                       required
                                       value="{{ Auth::user()->name ?? '' }}">
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <label class="">Adres email
                                <input class="form-control"
                                       type="email"
                                       name="email"
                                       required
                                       value="{{ Auth::user()->email ?? '' }}">
                            </label>
                        </div>
                        <div class="text-center">
                            <button class="btn-primary btn">Zapisz się</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>