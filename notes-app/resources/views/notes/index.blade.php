<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Notes</h1>
            </div>
            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <!-- Create Note button -->
                <a href="{{ route('notes.create') }}" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="max-xs:sr-only">Create Note</span>
                </a>
            </div>
        </div>
        <!-- Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="GET" class="mb-4">
                <div class="flex">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search notes..." class="w-full rounded-l-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-200">
                    <button type="submit" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white rounded-l-none">Search</button>
                </div>
            </form>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Title</div></th>
                            @if(auth()->user()->role === 'admin')
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Author</div></th>
                            @endif
                            <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Actions</div></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($notes as $note)
                            <tr>
                                <td class="p-2 whitespace-nowrap"><div class="font-medium text-gray-800 dark:text-gray-100">{{ $note->title }}</div></td>
                                @if(auth()->user()->role === 'admin')
                                    <td class="p-2 whitespace-nowrap"><div class="text-left">{{ $note->user->name }}</div></td>
                                @endif
                                <td class="p-2 whitespace-nowrap flex gap-4">
                                    <a href="{{ route('notes.show', $note) }}" class="text-blue-500 hover:underline">View</a>
                                    <a href="{{ route('notes.edit', $note) }}" class="text-yellow-500 hover:underline">Edit</a>
                                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-2 text-center text-gray-500 dark:text-gray-400">No notes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $notes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>