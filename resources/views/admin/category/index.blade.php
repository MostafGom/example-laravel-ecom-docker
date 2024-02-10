<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Category') }}
            </h2>

            <a href="{{ route('admincategorycreate') }}">
                <x-primary-button>
                    {{ __('Add Category') }}
                </x-primary-button>
            </a>

        </div>
    </x-slot>
    <div>
        @livewire('admin.category.index')
    </div>
</x-app-layout>
