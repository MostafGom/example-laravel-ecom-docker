<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Brand') }}
            </h2>

            <a href="{{ route('adminbrandcreate') }}">
                <x-primary-button>
                    {{ __('Add Brand') }}
                </x-primary-button>
            </a>

        </div>
    </x-slot>
    <div>
        <livewire:admin.brand.index />
    </div>
</x-app-layout>
