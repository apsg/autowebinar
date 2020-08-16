@extends('layouts.app')

@section('content')
    @if($webinar->isActive())
        @guest()
            @include('domains.webinar.subscribe')
        @endguest
        @auth()
            @include('domains.webinar.active')
        @endauth
    @elseif($webinar->isFuture())
        @include('domains.webinar.future')
    @else
        @include('domains.webinar.finished')
    @endif
@endsection