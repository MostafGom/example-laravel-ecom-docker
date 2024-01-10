<x-app-layout>
    <livewire:admin.category.category-form />
    <div class="">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Image Library') }}
            </h2>
            <x-primary-button class="" x-data="" type="button"
                x-on:click.prevent="$dispatch('open-modal', { name: 'add-image-modal'})">
                {{ __('Add images to gallery') }}
            </x-primary-button>
        </div>
        <div class="">
            <livewire:admin.image-library.index />
        </div>
    </div>
</x-app-layout>
