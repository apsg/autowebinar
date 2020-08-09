@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 card">
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