@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 rounded-lg">
            <div class="row justify-content-center mb-4">
                <img src="{{ asset('./assets/img/smkn1.jpeg') }}" alt="logo" class="rounded-pill">
            </div>
            <div class="row justify-content-center mb-2">
                <div class="card rounded-lg p-4" style="width: 25rem;">
                    <div class="card-body text-center">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="mb-4">Login</h2>
                            <input type="text" placeholder="email" class="form-control mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" placeholder="password" class="form-control mb-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                {{ __('Register') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection