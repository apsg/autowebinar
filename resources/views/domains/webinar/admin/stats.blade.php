@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
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
            @foreach($webinar->user)

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
