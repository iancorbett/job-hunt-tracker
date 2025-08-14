<x-app-layout>
  <x-slot name="header"><h2 class="text-xl font-semibold">New Company</h2></x-slot>

  <form method="POST" action="{{ route('companies.store') }}" class="max-w-xl space-y-4 bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
    @csrf
    <div>
      <label class="block text-sm font-medium">Name</label>
      <input name="name" class="mt-1 w-full rounded border p-2" required value="{{ old('name') }}">
      @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Website</label>
      <input name="website" class="mt-1 w-full rounded border p-2" value="{{ old('website') }}">
      @error('website')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Location</label>
      <input name="location" class="mt-1 w-full rounded border p-2" value="{{ old('location') }}">
      @error('location')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="flex gap-2">
      <button class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
      <a href="{{ route('companies.index') }}" class="rounded px-4 py-2">Cancel</a>
    </div>
  </form>
</x-app-layout>
