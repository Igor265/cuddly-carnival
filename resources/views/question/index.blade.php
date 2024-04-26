<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
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
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="dark:text-gray-400 uppercase font-bold mb-1">Drafts</div>
        <div class="space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach($questions->where('draft', true) as $item)
                        <x-table.tr>
                            <x-table.td>{{ $item->question }}</x-table.td>
                            <x-table.td>
                                <x-form delete :action="route('question.destroy', $item->id)" >
                                    <button
                                        type="submit"
                                        class="text-red-500 hover:text-red-700 hover:underline"
                                    >
                                        Delete
                                    </button>
                                </x-form>
                                <x-form put :action="route('question.publish', $item->id)" >
                                    <button
                                        type="submit"
                                        class="text-blue-500 hover:text-blue-700 hover:underline"
                                    >
                                        Publish
                                    </button>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="dark:text-gray-400 uppercase font-bold mb-1">My Questions</div>
        <div class="space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions->where('draft', false) as $item)
                    <x-table.tr>
                        <x-table.td>{{ $item->question }}</x-table.td>
                        <x-table.td>
                            <x-form delete :action="route('question.destroy', $item->id)" >
                                <button
                                    type="submit"
                                    class="text-red-500 hover:text-red-700 hover:underline"
                                >
                                    Delete
                                </button>
                            </x-form>
                            <x-form put :action="route('question.publish', $item->id)" >
                                <button
                                    type="submit"
                                    class="text-blue-500 hover:text-blue-700 hover:underline"
                                >
                                    Publish
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>
        </div>
    </x-container>
</x-app-layout>
