@extends('layouts.app')

@section('content')
    <p>Content</p>
    @if($webinar->isActive())
        <p>Is active</p>
        @guest()
            <p>Guest</p>
            @include('domains.webinar.subscribe')
        @endguest
        @auth()
            <p>Auth</p>
            @include('domains.webinar.active')
        @endauth
    @elseif($webinar->isFuture())
        @include('domains.webinar.future')
    @else
        @include('domains.webinar.finished')
    @endif
@endsection