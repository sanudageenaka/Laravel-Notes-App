<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">User Dashboard</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <!-- Add Note button -->
                <a href="{{ route('notes.create') }}" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="max-xs:sr-only">Create Note</span>
                </a>
            </div>

        </div>
        
        <!-- My Notes Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">My Notes</h2>
            @if($notes->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">You haven't created any notes yet. <a href="{{ route('notes.create') }}" class="text-blue-500 hover:underline">Create one now</a>.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Title</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Actions</div></th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($notes as $note)
                                <tr>
                                    <td class="p-2 whitespace-nowrap"><div class="font-medium text-gray-800 dark:text-gray-100">{{ $note->title }}</div></td>
                                    <td class="p-2 whitespace-nowrap">
                                        <a href="{{ route('notes.show', $note) }}" class="text-blue-500 hover:underline">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $notes->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>