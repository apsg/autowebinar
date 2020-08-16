@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 card pb-2">
                <form action="{{ route('admin.webinar.patch', $webinar) }}" method="post">
                    @csrf
                    @include('domains.webinar.admin.form')
                    <button class="btn btn-primary">Zapisz</button>
                </form>
            </div>
            <div class="col-md-12 card mt-2">
                <h3 class="mt-2">Zaplanowane wiadomości</h3>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>Czas [s]</td>
                        <td>Nick</td>
                        <td>Wiadomość</td>
                        <td>Akcje</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($webinar->scheduled_messages as $message)
                        <x-scheduled-message-component :message="$message"></x-scheduled-message-component>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <form action="{{ route('admin.scheduled.store', $webinar) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <input required class="form-control" type="number" min="0" name="time"
                                               placeholder="czas [s]">
                                    </div>
                                    <div class="col-md-3">
                                        <input required class="form-control" type="text" name="name" placeholder="Nick">
                                    </div>
                                    <div class="col-md-3">
                                        <input required class="form-control" type="text" name="message" placeholder="Wiadomość">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            Dodaj
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12 card mt-2 pb-3">
                <h3 class="mt-2">Importuj wiadomości</h3>
                <form action="{{ route('admin.scheduled.import', $webinar) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <label>Plik CSV z wiadomościami w formacie czas[s];nick;wiadomość</label>
                            <input type="file" name="file" accept="text/csv" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary">
                                <i class="fa fa-upload"></i>
                                Importuj plik
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 card py-3 mt-2">
                <h3>Wezwania do działania</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>Tytuł</td>
                        <td>Opis</td>
                        <td>Opóźnienie [s]</td>
                        <td>Czas wyświetlania [s]</td>
                        <td>Link przycisku</td>
                        <td>Napis na przycisku</td>
                        <td>Opcje</td>
                    </tr>
                    </thead>
                    @foreach($webinar->ctas as $cta)
                        <x-cta :cta="$cta"></x-cta>
                    @endforeach
                </table>

                <div>
                    <h5>Utwórz wezwanie do działania</h5>
                    <form action="{{ route('admin.cta.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="webinar_id" value="{{ $webinar->id }}">

                        <div class="form-group">
                            <label class="col-form-label">Nazwa</label>
                            <input class="form-control" type="text" name="title" required/>
                        </div>
                        <div class="form-group">
                            <label>Opis</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Opóźnienie [s]</label>
                                <p class="alert alert-info">
                                    Uwaga: opóźnienie liczone jest od momentu rozpoczęcia oglądania przez użytkownika,
                                    nie
                                    od chwili startu webinara.
                                </p>
                                <input class="form-control"
                                       min="0"
                                       max="1000"
                                       type="number" name="delay" required
                                       placeholder="czas w sekundach"
                                />
                            </div>
                            <div class="form-group col-6">
                                <label>Czas trwania [s]</label>
                                <input class="form-control"
                                       min="1"
                                       max="1000"
                                       type="number" name="duration" required
                                       placeholder="czas w sekundach"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Url przycisku</label>
                                <input type="text"
                                       name="button_url"
                                       placeholder="url"
                                       class="form-control"
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tekst przycisku</label>
                                <input type="text"
                                       name="button_text"
                                       placeholder="tekst"
                                       class="form-control"
                                >
                            </div>
                        </div>
                        <button class="btn btn-primary">Dodaj</button>

                    </form>
                </div>


            </div>

            <div class="col-md-12 card mt-2 pb-3">
                <h3 class="mt-2">Usuń webinar</h3>
                <p>Uwaga! To działanie nie będzie mogło być cofnięte!</p>
                <form action="{{ route('admin.webinar.destroy', $webinar) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger confirm" onclick="return confirm('Na pewno?')">
                        <i class="fa fa-trash"></i>
                        Usuń webinar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection