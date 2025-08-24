<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-sm border border-gray-200 dark:border-gray-700 p-6">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mb-4">{{ $note->title }}</h1>
            <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                {!! nl2br(e($note->content)) !!}
            </div>
            <div class="mt-6">
                <a href="{{ route('notes.index') }}" class="btn border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 text-gray-800 dark:text-gray-300">
                    &larr; Back to Notes
                </a>
            </div>
        </div>
    </div>
</x-app-layout>