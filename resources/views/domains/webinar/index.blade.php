@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($webinars as $webinar)
            <a href="{{ route('webinar.show', $webinar) }}" class="btn btn-primary">
                {{ $webinar->name }}
            </a>
        @endforeach
    </div>
@endsection