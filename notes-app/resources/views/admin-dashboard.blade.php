<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Admin Dashboard</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <!-- Add view button -->
                <a href="{{ route('notes.index') }}" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <span>Manage All Notes</span>
                </a>
            </div>

        </div>
        
        <!-- Notes List Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">All Notes in the System</h2>
            @if($notes->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No notes in the system yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Title</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Author</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Actions</div></th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($notes as $note)
                                <tr>
                                    <td class="p-2 whitespace-nowrap"><div class="font-medium text-gray-800 dark:text-gray-100">{{ $note->title }}</div></td>
                                    <td class="p-2 whitespace-nowrap"><div class="text-left">{{ $note->user->name }}</div></td>
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