@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your profile') }}</div>

                <div class="card-body">
                    <div class="col-md-6 offset-md-4">
                        <p>Name: {{ $user->name }}</p>
                        <p>Email: {{ $user->email }}</p>
                        <p>Registered: {{ $user->created_at ?? 'No info' }}</p>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <a href="{{ url('user/edit')}}" class="btn btn-warning">
                            Edit profile
                        </a>
                        <a href="{{ url('user/delete')}}" class="btn btn-danger">
                            Delete profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
