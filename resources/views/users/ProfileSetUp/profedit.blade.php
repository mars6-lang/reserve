@extends('layouts.Users.Homeapp')

@section('content')

    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Edit Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('GET')
            <div class="mb-4">
                <label class="block">Full Name:</label>
                <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name ?? '') }}"
                    class="border p-2 w-full">
            </div>
            <div class="mb-4">
                <label class="block">About Me:</label>
                <textarea name="about" class="border p-2 w-full">{{ old('about', $profile->about ?? '') }}</textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Save</button>
        </form>
    </div>


@endsection








\App\Models\Profile::updateOrCreate(
    ['user_id' => 1],
    ['image_path' => 'profile_photos/sample.jpg']
);