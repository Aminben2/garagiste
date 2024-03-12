{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- first Name and last name-->
        <div class="flex flex-row justify-between ">
            <div>
                <label for="firstName" value="__('Fisrt Name')" />
                <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" value="old('firstName')"
                    required autofocus autocomplete="firstName" />
                <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
            </div>

            <div>
                <label for="lastName" value="__('Last Name')" />
                <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" value="old('lastName')"
                    required autofocus autocomplete="lastName" />
                <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </div>
        </div>


        <div class="mt-2">
            <label for="username" value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" value="old('username')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="address" value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="old('address')"
                required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="phoneNumber" value="__('Phone Number')" />
            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber"
                value="old('phoneNumber')" required autofocus autocomplete="phoneNumber" />
            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="row g-0">
                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                    <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/login-images/register-cover.svg') }}"
                                class="img-fluid auth-img-cover-login" width="550" alt="" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                        <div class="card-body p-sm-5">
                            <div class="">
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('assets/images/logo-icon.png') }}" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">Dashrock Admin</h5>
                                    <p class="mb-0">Please fill the below details to create your account</p>
                                </div>
                                <div class="form-body">
                                    <form method="POST" action="{{ route('register') }}" class="row g-3">
                                        @csrf
                                        <div class="col-6">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="firstName" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="firstName" value="{{ old('firstName') }}" required autofocus
                                                        placeholder="Your first name" autocomplete="firstName">
                                                    @error('firstName')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastName"
                                                        name="lastName" value="{{ old('lastName') }}" required autofocus
                                                        autocomplete="lastName" placeholder="Your last name">
                                                    @error('lastName')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ old('username') }}" required autofocus autocomplete="username"
                                                placeholder="Jhon">
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ old('address') }}" required autofocus autocomplete="address"
                                                placeholder="Enter your address">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                                value="{{ old('phoneNumber') }}" required autofocus
                                                placeholder="Enter your phone number" autocomplete="phoneNumber">
                                            @error('phoneNumber')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" required autofocus autocomplete="email"
                                                placeholder="example@user.com">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">

                                                <input type="password" class="form-control" id="password"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Retype your Password">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Sign up</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <p class="mb-0">{{ __('Already have an account?') }} <a
                                                        href="{{ route('login') }}">{{ __('Sign in here') }}</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="login-separater text-center mb-5">
                                    <span>OR SIGN UP WITH EMAIL</span>
                                    <hr />
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
@endsection
