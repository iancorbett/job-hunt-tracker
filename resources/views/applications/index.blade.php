<x-app-layout>
  <x-slot name="header"><h2 class="text-xl font-semibold">Applications</h2></x-slot>

  @if (session('ok'))
    <div class="mb-3 rounded bg-green-100 p-2 text-green-800">{{ session('ok') }}</div>
  @endif

  <div class="mb-3 flex items-center gap-3">
    <a href="{{ route('applications.create') }}" class="rounded bg-blue-600 px-3 py-2 text-white">+ New Application</a>
    <form method="GET" class="ml-auto">
      <select name="status" class="rounded border p-2" onchange="this.form.submit()">
        <option value="">All statuses</option>
        @foreach (['Saved','Applied','Interview','Offer','Rejected'] as $s)
          <option value="{{ $s }}" @selected(request('status')===$s)>{{ $s }}</option>
        @endforeach
      </select>
    </form>
  </div>

  <div class="overflow-x-auto rounded border bg-white dark:bg-gray-800">
    <table class="min-w-full divide-y">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Company</th>
          <th class="px-4 py-2 text-left">Role</th>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-left">Applied</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @forelse($applications as $a)
          <tr>
            <td class="px-4 py-2">{{ $a->company?->name ?? '—' }}</td>
            <td class="px-4 py-2">{{ $a->role }}</td>
            <td class="px-4 py-2">{{ $a->status }}</td>
            <td class="px-4 py-2">{{ optional($a->applied_at)->format('Y-m-d') }}</td>
            <td class="px-4 py-2 text-right">
              <a href="{{ route('applications.edit',$a) }}" class="mr-2 text-blue-600 underline">Edit</a>
              <form action="{{ route('applications.destroy',$a) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-600 underline" onclick="return confirm('Delete application?')">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="px-4 py-6" colspan="5">No applications yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $applications->links() }}</div>
</x-app-layout>
