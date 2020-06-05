@extends('layouts.app')

@section('content')
    @if($webinar->isActive())
        @include('domains.webinar.active')
    @elseif($webinar->isFuture())
        @include('domains.webinar.future')
    @else
        @include('domains.webinar.finished')
    @endif
@endsection