<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Brand') }}
            </h2>

            <x-primary-button class="" x-data="" type="button"
                x-on:click.prevent="$dispatch('open-modal', { name: 'add-variant-modal'})">
                {{ __('Add Variant') }}
            </x-primary-button>

        </div>
    </x-slot>
    <div class="">
        <livewire:admin.variant.index />
    </div>
</x-app-layout>
