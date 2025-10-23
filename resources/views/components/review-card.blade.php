<!-- review-card.blade.php -->
<div class="border rounded-lg shadow-sm p-4 mb-4">
    <div class="flex items-top mb-3 space-x-3 justify-between">
        <div class="flex items-top space-x-3 flex-1">
            <img src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}'s photo"
                class="w-12 h-12 rounded-full object-cover border border-gray-300 shadow-sm aspect-square">

            <div class="min-w-0 max-w-full">
                <strong>{{ $review->user->name }}</strong>
                <small class="text-gray-500">{{ $review->created_at->diffForHumans() }}</small><br>
                <strong class="text-yellow-500 text-sm">Rated:
                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</strong><br>
                <strong
                    class="text-gray-800 text-sm break-words whitespace-pre-line block mt-3">{{ $review->comment }}</strong>
            </div>
        </div>

        {{-- Edit/Delete buttons for review author --}}
        @if (auth()->check() && auth()->id() === $review->user_id)
            <div class="flex gap-2 ml-3">
                <button class="text-sm text-blue-600 hover:underline" onclick="editReview({{ $review->id }}, {{ $review->rating }}, '{{ addslashes($review->comment) }}')">✏️ Edit</button>
                <form action="{{ route('users.reviews.delete', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this review?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:underline">🗑️ Delete</button>
                </form>
            </div>
        @endif
    </div>

    @if ($review->photo)
        <img src="{{ asset('storage/' . $review->photo) }}" alt="Review Photo"
            class="rounded w-full sm:w-60 h-36 object-cover mt-2">
    @endif

    @if($review->replies->count())
        @php
            $visibleReplies = $review->replies->take(2);
            $hiddenReplies = $review->replies->skip(2);
        @endphp

        <div class="ml-5 mt-4 space-y-2" x-data="{ showMoreReplies: false }">
            {{-- Show first 2 replies --}}
            @foreach($visibleReplies as $reply)
                <div class="bg-gray-50 border rounded px-3 py-2">
                    <div class="flex items-center space-x-2 mb-1">
                        <img src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}"
                            class="rounded-full w-11 h-11 object-cover aspect-square">
                        <strong class="text-sm">{{ $reply->user->name }}</strong>
                        <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-sm ml-12 px-2 break-words whitespace-pre-line">{{ $reply->reply }}</p>
                </div>
            @endforeach

            {{-- Hidden/collapsible replies --}}
            @if($hiddenReplies->count())
                <div x-show="showMoreReplies" x-collapse>
                    @foreach($hiddenReplies as $reply)
                        <div class="bg-gray-50 border rounded px-3 py-2">
                            <div class="flex items-center space-x-2 mb-1">
                                <img src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}"
                                    class="rounded-full w-11 h-11 object-cover aspect-square">
                                <strong class="text-sm">{{ $reply->user->name }}</strong>
                                <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="text-sm ml-12 px-2 break-words whitespace-pre-line">{{ $reply->reply }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Toggle button --}}
                <button @click="showMoreReplies = !showMoreReplies"
                    class="text-xs mt-2 px-2 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                    <span x-show="!showMoreReplies">Show more replies ({{ $hiddenReplies->count() }})</span>
                    <span x-show="showMoreReplies">Hide replies</span>
                </button>
            @endif
        </div>
    @endif

    @auth
        <form action="{{ route('users.reviews.reply', $review->id) }}" method="POST" class="mt-3 ml-5">
            @csrf
            <textarea name="reply" rows="2" class="form-control w-full resize-none text-sm" placeholder="Write a reply..."
                maxlength="300"></textarea>
            <button type="submit" class="btn btn-sm btn-outline-info mt-2">Reply</button>
        </form>
    @endauth
</div>