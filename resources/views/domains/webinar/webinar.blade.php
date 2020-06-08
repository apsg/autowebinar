@extends('layouts.app')

@section('content')
    @if($webinar->isActive())
        @auth
            @include('domains.webinar.active')
        @endauth
        @guest()
            @include('domains.webinar.finished')
        @endguest
    @elseif($webinar->isFuture())
        @include('domains.webinar.future')
        @include('domains.webinar.subscribe')
    @else
        @include('domains.webinar.finished')
    @endif
@endsection