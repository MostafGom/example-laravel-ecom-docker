<div>

    <form wire:submit.prevent="addBrand" x-on:close-add-brand-modal.window="show=false"
        class="p-6 bg-gray-900 dark:bg-white shadow-maintomato rounded-2xl">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add brand') }}
        </h2>
        <hr class="my-6">
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    wire:model="brand.name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="slug"
                    :value="__('Slug')" />
                <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                    wire:model="brand.slug" required />
                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="is_active"
                    :value="__('Active')" />
                <input type="checkbox" class="form-checkbox rounded text-pink-500" wire:model="brand.is_active"
                    {{ $brand->is_active ? 'checked' : '' }} />
                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
            </div>
        </div>
        <div>
            @include('livewire.admin.brand.image-gallery-options')

        </div>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">&nbsp;</p>
        <div class="mt-6 flex justify-end gap-4">
            <x-secondary-button type="submit">
                {{ __('Create') }}
            </x-secondary-button>

            <x-primary-button type="button">
                <a href="{{ route('adminbrand') }}">
                    {{ __('Cancel') }}
                </a>
            </x-primary-button>


        </div>
    </form>


    @include('components.image-preview-modal')
    @include('components.add-image-modal')
</div>
