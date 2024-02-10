<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product') }}
            </h2>

            <a href="{{ route('adminproductcreate') }}">
                <x-primary-button>
                    {{ __('Add Product') }}
                </x-primary-button>
            </a>

        </div>
    </x-slot>
    <div>
        @livewire('admin.product.index')
    </div>
</x-app-layout>
