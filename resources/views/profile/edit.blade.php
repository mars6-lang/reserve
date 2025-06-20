@extends('layouts.Users.Homeapp')

@section('content')
    {{-- Flash Message --}}
    @if (session('success') === 'Profile updated!')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            Profile updated!
        </div>
    @endif


    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Welcome Header --}}
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900">Welcome back, {{ Auth::user()->name }}</h2>
                <p class="mt-2 text-gray-600">Manage your account details below.</p>
            </div>

            {{-- Profile Update Card --}}
            <div class="bg-white p-6 border border-red-300 transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800"> Update Profile</h3>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    @include('profile.partials.updateform')
                </div>
            </div>

            {{-- Password Update Card --}}
            <div class="bg-white p-6 border border-red-300 transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Change Password</h3>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    @include('profile.partials.password-form')
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="bg-white p-6 border border-red-300 transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-red-700">Delete Account</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    This action is irreversible. All your data will be permanently removed.
                </p>
                <div class="border-t border-gray-200 pt-4">
                    @include('profile.partials.deleteform')
                </div>
            </div>

        </div>
    </div>
@endsection