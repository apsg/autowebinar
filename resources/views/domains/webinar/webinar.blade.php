@extends('layouts.app')

@section('content')
    @guest()
        @if($webinar->isFuture())
            @include('domains.webinar.future')
            @include('domains.webinar.subscribe')
        @else
            @include('domains.webinar.finished')
        @endif
    @endguest

    @auth()
        @if($webinar->isActive())
            @include('domains.webinar.active')
        @elseif($webinar->isFuture())
            @include('domains.webinar.future')
        @else
            @include('domains.webinar.finished')
        @endif
    @endauth
@endsection