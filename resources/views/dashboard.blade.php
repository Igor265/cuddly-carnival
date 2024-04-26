<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>
    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea
                label="Question"
                name="question"
            />
            <x-btn.primary>
                Save
            </x-btn.primary>
            <x-btn.reset>
                Cancel
            </x-btn.reset>
        </x-form>
        {{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
        {{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
        {{--                    {{ __("You're logged in!") }}--}}
        {{--                </div>--}}
        {{--            </div>--}}
    </x-container>
</x-app-layout>
