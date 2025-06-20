@extends('layouts.Users.Homeapp')

@section('content')




    <h2 class="text-xl font-bold mb-4 text-center mt-5">My Chats</h2>

    <div class="max-w-5xl mx-auto p-6 bg-light rounded-lg shadow-md" style="height: 400px; overflow-y: scroll;">
        @forelse($contacts as $contact)
            <div class="flex items-center mb-4 gap-4">
                {{-- Profile Photo --}}
                <img src="{{ $contact->profile_photo_url ?? asset('images/default-user.png') }}"
                    alt="{{ $contact->name }}'s Photo" class="w-10 h-10 rounded-full object-cover ring-2 ring-blue-400">

                {{-- Contact Name & Link --}}
                <div class="flex-1">
                    <a href="{{ route('chatroom.show', $contact->id) }}" class="text-blue-600 hover:underline font-medium">
                        {{ $contact->name }}
                    </a>


                    {{-- Optional Product Preview --}}
                    @if(isset($contactProducts[$contact->id]) && $contactProducts[$contact->id])
                        <div class="mt-1 flex items-center gap-2">
                            <img src="{{ asset('storage/' . $contactProducts[$contact->id]->image) }}"
                                class="w-8 h-8 rounded border object-cover" alt="Product Image">
                            <span class="text-sm text-gray-600">{{ $contactProducts[$contact->id]->title }}</span>
                        </div>
                    @endif
                </div>
            </div>
            @empty

            <h1 class="text-center">no chats yet</h1>
        @endforelse
    </div>









@endsection