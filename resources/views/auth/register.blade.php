@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="row justify-content-center mb-4">
                <img src="{{ asset('./assets/img/smkn1.jpeg') }}" alt="logo" class="rounded-pill">
            </div>
            <div class="row justify-content-center mb-2">
                <div class="card rounded-lg p-4" style="width: 25rem;">
                    <div class="card-body text-center">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h2 class="mb-4">Register</h2>
                            <input placeholder="name" id="name" type="text" class="form-control mb-4 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input placeholder="email" id="email" type="email" class="form-control mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input placeholder="password" id="password" type="password" class="form-control mb-4 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input placeholder="confirm password" id="password-confirm" type="password" class="form-control mb-4" name="password_confirmation" required autocomplete="new-password">

                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                {{ __('Login') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
