@props([
    'name',
    'errorDeletion',
    'destroyMethod',
    'confirmationMessage',
    'confirmationWarningMessage',
    'closeEvent',
])
<x-modal wire:ignore.self name="{{ $name }}" focusable>
    <form wire:submit.prevent="{{ $destroyMethod }}" class="p-6" x-on:{{ $closeEvent }}.window="show=false">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __($confirmationMessage) }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __($confirmationWarningMessage) }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Category') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
