<form action="{{ route('users.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="rating" class="form-label">Rating</label>
        <select name="rating" id="rating" class="form-select" required>
            <option value="">-Select Rating-</option>
            @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
            @endfor
        </select>
    </div>

    <div>
        <label for="comment" class="form-label">Comment</label>
        <textarea name="comment" id="comment" rows="3" class="form-control" required>{{ $review->comment }}</textarea>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Update Review</button>
        <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
    </div>
</form>
