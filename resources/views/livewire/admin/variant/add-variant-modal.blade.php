<x-modal wire:ignore.self name="add-variant-modal" :show="$errors->variantAddition->isNotEmpty()" focusable>

    <form wire:submit.prevent="addVariant" class="p-6" x-on:close-add-variant-modal.window="show=false">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 p-6">
            {{ __('Add variant') }}
        </h2>
        <hr class="my-6">
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">&nbsp;</p>
        <div class="mt-6 flex justify-end gap-4 p-6">
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>

            <x-secondary-button x-on:click.prevent="$dispatch('close')" wire:click="resetInputs">
                {{ __('Cancel') }}
            </x-secondary-button>


        </div>
    </form>

</x-modal>
