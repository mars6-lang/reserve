@extends('layouts.Users.Homeapp')



@section('content')
    <div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 80vh;">
        <div class="card shadow-sm border-0 rounded-4 w-100 bg-white" style="max-width: 420px;">
            <div class="card-body p-4">


                <!-- Title -->
                <h4 class="text-center fw-bold mb-4">Log In</h4>

                <!-- Session Status -->
                <x-auth-session-status class="mb-3" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="form-control rounded-pill mt-1" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="form-control rounded-pill mt-1" type="password" name="password"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label small text-muted">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-column gap-2">
                        <!-- Custom Button -->
                        <x-primary-button class="btn btn-Log w-100 rounded-pill" style="background-color: #056659ff !important;">
                            {{ __('Log in') }}
                        </x-primary-button>

                        @if (Route::has('password.request'))
                            <div class="d-flex justify-content-between small">
                                <a class="text-decoration-none text-dark" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                                <a class="text-decoration-none text-dark" href="{{ route('register') }}">
                                    {{ __('Register now') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection