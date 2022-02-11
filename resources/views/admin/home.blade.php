@extends('layouts.sbadmin')
@section('title', 'Home - Admin')
@section('content')
<div class="card mx-3">
    <div class="card-header">{{ __('Dashboard Admin') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('msg'))
            <div class="alert alert-danger" role="alert">
                {{ session('msg') }}
            </div>
        @endif

        {{ __('Kamu adalah ').Auth::user()->level }}
    </div>
</div>
@endsection
