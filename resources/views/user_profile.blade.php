@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
        <div class="row">
            <div class="panel-body">
                <a href="/users" type="button" class="btn btn-info pull-left">Usuarios</a>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <profile-user></profile-user>
                </div>
            </div>
        </div>
    </div>
@endsection

