@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 card">
                <div class="card-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.webinar.create') }}"
                           class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Dodaj nowy
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Data</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($webinars as $webinar)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.webinar.edit', $webinar) }}">
                                        {{ $webinar->name }}
                                    </a>
                                </td>
                                <td>
                                    {{ $webinar->scheduled_at->setTimezone('Europe/Warsaw') }}
                                    ({{ $webinar->scheduled_at->diffForHumans() }})
                                </td>
                                <td>
                                    <input
                                            class="form-control"
                                            type="text" disabled value="{{ $webinar->getLink() }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection