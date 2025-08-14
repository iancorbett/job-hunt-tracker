<x-app-layout>
  <x-slot name="header"><h2 class="text-xl font-semibold">New Application</h2></x-slot>

  <form method="POST" action="{{ route('applications.store') }}" class="max-w-2xl space-y-4 bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
    @csrf

    <label class="block">
      <span class="block text-sm">Company</span>
      <select name="company_id" class="mt-1 w-full rounded border p-2" required>
        <option value="">Select company…</option>
        @foreach ($companies as $c)
          <option value="{{ $c->id }}" @selected(old('company_id')==$c->id)>{{ $c->name }}</option>
        @endforeach
      </select>
      @error('company_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </label>

    <label class="block">
      <span class="block text-sm">Role</span>
      <input name="role" class="mt-1 w-full rounded border p-2" required value="{{ old('role') }}">
      @error('role')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </label>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      <label class="block">
        <span class="block text-sm">Status</span>
        <select name="status" class="mt-1 w-full rounded border p-2" required>
          @foreach (['Saved','Applied','Interview','Offer','Rejected'] as $s)
            <option value="{{ $s }}" @selected(old('status')===$s)>{{ $s }}</option>
          @endforeach
        </select>
        @error('status')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
      </label>
      <label class="block">
        <span class="block text-sm">Salary Min</span>
        <input type="number" name="salary_min" class="mt-1 w-full rounded border p-2" value="{{ old('salary_min') }}">
        @error('salary_min')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
      </label>
      <label class="block">
        <span class="block text-sm">Salary Max</span>
        <input type="number" name="salary_max" class="mt-1 w-full rounded border p-2" value="{{ old('salary_max') }}">
        @error('salary_max')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
      </label>
    </div>

    <label class="block">
      <span class="block text-sm">Applied At</span>
      <input type="date" name="applied_at" class="mt-1 w-full rounded border p-2" value="{{ old('applied_at') }}">
      @error('applied_at')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </label>

    <label class="block">
      <span class="block text-sm">Notes</span>
      <textarea name="notes" rows="4" class="mt-1 w-full rounded border p-2">{{ old('notes') }}</textarea>
      @error('notes')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </label>

    <button class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
  </form>
</x-app-layout>
