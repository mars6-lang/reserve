<section class="max-w-3xl mx-auto p-8">
    <header class="mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Profile Information</h2>
        <p class="text-sm text-gray-500 dark:text-black-300 mt-1">
            Update your profile photo, name, and email address.
        </p>
    </header>


    @if (session('status') === 'Profile updated!')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            Profile updated!
        </div>
    @endif


    {{-- Profile Update Form --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Profile Photo --}}
        <div class="flex items-center space-x-4 mb-6">
            <div>
                <img id="photo-preview"
                    src="{{ Auth::user()->profile_photo_path ? Auth::user()->profile_photo_url : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                    alt="Profile Photo" class="w-20 h-20 rounded-full object-cover ring-2 ring-blue-500">
            </div>
            <div class="flex-1">
                <label for="photo" class="block text-sm font-medium text-black-700 dark:text-black-200 mb-1">
                    Change Profile Photo
                </label>
                <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0 file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('photo')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Save Changes
            </button>
        </div>
    </form>
</section>

{{-- Live preview script --}}
<script>
    document.getElementById('photo').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const preview = document.getElementById('photo-preview');
            preview.src = URL.createObjectURL(file);
        }
    });
</script>