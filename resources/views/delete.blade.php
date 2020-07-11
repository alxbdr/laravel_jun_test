@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuwanie kodow</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('codes/destroy') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="Codes" class="col-md-4 col-form-label text-md-right"><b>Wpisz kody do usuniecia</b></label>

                            <div class="col-md-6">
                                <textarea id="codes" name="codes" class="form-control @error('codes') is-invalid @enderror" required autocomplete="codes" autofocus>{{ old('codes') }}</textarea>
                                    @error('codes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Usun
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection