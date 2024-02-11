<x-modal wire:ignore.self name="variant-attribute-form-modal" :show="$errors->variantAddition->isNotEmpty()" focusable>

    <form wire:submit.prevent="saveVariantAttribute" class="p-6"
        x-on:close-variant-attribute-form-modal.window="show=false">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 p-6">
            {{ __('Add Variant Attribute') }}
        </h2>
        <hr class="my-6">

        {{-- VARIANTS --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">

            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-white" for="variant" :value="__('Choose Variant')" />
                <div class="fullwidthselect2 mt-2" wire:ignore>
                    <select wire:model="variant_id" class="w-full" id="variant_id" data-placeholder="Choose Variant">
                        <option></option>
                        @foreach ($allVariants as $variant)
                            <option wire:key="{{ $variant->id }}-{{ $variant->name }}" value="{{ $variant->id }}">
                                {{ $variant->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- ATTRIBUTE NAME --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label for="name" :value="__('Attribute Name')" class="font-bold text-xl text-white dark:text-white" />
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
