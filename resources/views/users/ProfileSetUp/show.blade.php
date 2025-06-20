@extends('layouts.Users.Homeapp')

@section('content')
    @section('content')
        <div class="p-6">
            <h1 class="text-xl font-bold">Your Profile</h1>
            <p><strong>Name:</strong> {{ $profile->full_name ?? 'Not set' }}</p>
            <p><strong>About:</strong> {{ $profile->about ?? 'Not set' }}</p>
            <a href="{{ route('profile.edit') }}" class="text-blue-500">Edit Profile</a>
        </div>
    @endsection

@endsection