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
                <th>Start</th>
                <th>Stop</th>
                <th>Czas</th>
            </tr>
            </thead>
            <tbody>
            @foreach($webinar->users()->get() as $user)
                <tr>
                    <td>
                        {{ $user->name }} ({{ $user->email }})
                    </td>
                    <td>
                        {{ $user->pivot->started_at?->format('Y-m-d H:i:s') }}
                    </td>
                    <td>
                        {{ $user->pivot->finished_at?->format('Y-m-d H:i:s') }}
                    </td>
                    <td>
                        {{ $user->pivot->getTimeSpentFormatted() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
