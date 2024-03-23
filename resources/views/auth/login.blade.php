{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.guest')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="">
        <div class="wrapper">
            @if (!empty(session('status')))
                @component('admin.components.seccuss-alert', [
                    'title' => __('Success Alerts'),
                    'subTitle' => session('status'),
                ])
                @endcomponent
            @endif
            <div class="section-authentication-cover">
                <div class="">
                    <div class="row g-0">
                        <div
                            class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                            <div class="card bg-transparent shadow-none rounded-0 mb-0">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/login-images/login-cover.svg') }}"
                                        class="img-fluid auth-img-cover-login" width="650" alt="" />
                                </div>
                            </div>

                        </div>


                        <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                            <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                                <div class="card-body p-sm-5">
                                    <div class="">
                                        <div class="mb-3 text-center">
                                            <img src="{{ asset('assets/images/logo-icon.png') }}" width="60"
                                                alt="">
                                        </div>
                                        <div class="text-center mb-4">
                                            <h5 class="">Dashrock Admin</h5>
                                            <p class="mb-0">Please log in to your account</p>
                                        </div>
                                        <div class="form-body">
                                            <form method="POST" action="{{ route('login') }}" class="row g-3">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                                    <input id="inputEmailAddress" class="form-control" type="email"
                                                        name="email" value="{{ old('email') }}" required autofocus
                                                        placeholder="jhon@example.com" />
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input id="inputChoosePassword" class="form-control" type="password"
                                                            name="password" required autocomplete="current-password"
                                                            placeholder="Enter Password" />
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                                class="bx bx-hide"></i></a>
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="remember_me"
                                                            name="remember">
                                                        <label class="form-check-label" for="remember_me">Remember
                                                            Me</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                                    @endif
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center ">
                                                        <p class="mb-0">Don't have an account yet? <a
                                                                href="{{ route('register') }}">Sign up here</a></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="login-separater text-center mb-5">
                                            <span>OR SIGN IN WITH</span>
                                            <hr>
                                        </div>
                                        <div class="list-inline contacts-social text-center">
                                            <a href="javascript:;"
                                                class="list-inline-item bg-facebook text-white border-0 rounded-3"><i
                                                    class="bx bxl-facebook"></i></a>
                                            <a href="javascript:;"
                                                class="list-inline-item bg-twitter text-white border-0 rounded-3"><i
                                                    class="bx bxl-twitter"></i></a>
                                            <a href="javascript:;"
                                                class="list-inline-item bg-google text-white border-0 rounded-3"><i
                                                    class="bx bxl-google"></i></a>
                                            <a href="javascript:;"
                                                class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i
                                                    class="bx bxl-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
@endsection
