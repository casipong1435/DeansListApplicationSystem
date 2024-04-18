@extends('layouts.app')

@section('page-title', 'Login')

@section('content')

@include('auth.partial')

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row text-center mb-3">
                                <div class="form-group mb-2">
                                    <img src="images/logo.jpg" alt="TCGC logo" height="100" width="100" style="border-radius: 50%">
                                </div>
                                <div class="form-group fw-bold text-success">Dean's List Application System</div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group mb-3">
                                    <label for="username" class="col-form-label">{{ __('Username') }}</label>
                                    <input id="username" type="username" class="custom-form p-2 w-100 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Enter Username">
        
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
    
                                    <input id="password" type="password" class="custom-form p-2 w-100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success w-100 ">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>

                            <div class="row mt-3">
                                @if (session()->get('failed'))
                                    <div class="form-group mb-2">
                                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                            <strong>Error!</strong> {{session()->get('failed')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
