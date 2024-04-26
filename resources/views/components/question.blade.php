@props([
    'question'
])

<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-400 bg-white overflow-hidden sm:rounded-lg text-gray-900">
    {{ $question->question }}
</div>
