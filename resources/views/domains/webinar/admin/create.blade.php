@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 card">
                <form action="{{ route('admin.webinar.store') }}" method="post">
                    @csrf
                    @include('domains.webinar.admin.form')
                    <button class="btn btn-primary">Zapisz</button>
                </form>
            </div>
        </div>
    </div>
@endsection