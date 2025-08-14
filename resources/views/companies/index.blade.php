<x-app-layout>
  <x-slot name="header"><h2 class="text-xl font-semibold">Companies</h2></x-slot>

  @if (session('ok'))
    <div class="mb-3 rounded bg-green-100 p-2 text-green-800">{{ session('ok') }}</div>
  @endif

  <a href="{{ route('companies.create') }}" class="inline-block rounded bg-blue-600 px-3 py-2 text-white">+ New Company</a>

  <div class="mt-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="p-4">
      @forelse($companies as $c)
        <div class="flex items-center justify-between border-b py-3 last:border-0">
          <div>
            <div class="font-semibold">{{ $c->name }}</div>
            <div class="text-sm text-gray-500">
              {{ $c->location ?? '—' }}
              @if($c->website) · <a class="text-blue-600 underline" href="{{ $c->website }}" target="_blank">website</a>@endif
            </div>
          </div>
          <div class="text-sm">
            <a href="{{ route('companies.edit',$c) }}" class="mr-3 text-blue-600 underline">Edit</a>
            <form action="{{ route('companies.destroy',$c) }}" method="POST" class="inline">
              @csrf @method('DELETE')
              <button onclick="return confirm('Delete company?')" class="text-red-600 underline">Delete</button>
            </form>
          </div>
        </div>
      @empty
        <p>No companies yet.</p>
      @endforelse

      <div class="mt-4">{{ $companies->links() }}</div>
    </div>
  </div>
</x-app-layout>
