<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Variant Attribute') }}
            </h2>

            <x-primary-button x-data="" type="button"
                x-on:click.prevent="$dispatch('open-modal', { name: 'add-variant-attribute-modal'})">
                {{ __('Add Variant Attribute') }}
            </x-primary-button>

        </div>
    </x-slot>
    <div>
        @livewire('admin.variant-attribute.index')
    </div>
</x-app-layout>
