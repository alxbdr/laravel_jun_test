@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista kodow') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($codes) > 0)
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Kod</th>
                                    <th>Dodany</th>
                                    <th>Uzytkownik</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($codes as $code)
                                    <tr>
                                        <th>{{ $code->id }}</th>
                                        <th>{{ $code->code }}</th>
                                        <th>{{ $code->created_at }}</th>
                                        <th>{{ $code->user->name }}</th>
                                        <th>{{ $code->user->email }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        Brak kodów w bazie danych
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
