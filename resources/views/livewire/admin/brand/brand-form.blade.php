<div x-data="selectedImageComponent" x-init="$watch('selectedImage', (val) => {
    console.log(val);
    $wire.brandImage = selectedImage
    $wire.brand.image_id = selectedImage.id
});">

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


        {{-- BRAND IMAGE --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="brand_id" :value="__('Brand Thumbnail:')" />
            <p x-show="selectedImage.id == 0" x-text="'No Thumbnail Selected'" class="text-center text-red-600">
            </p>

            <div class="flex gap-4 justify-start items-center  flex-wrap my-4">
                <div x-cloak x-show="selectedImage.image_path != ''" class="relative p-4 rounded-lg bg-gray-100">
                    <img class='w-[100px] h-[100px] object-contain' :src="selectedImage.image_path" alt="imagealt">
                    <button type='button' class="bg-red-600 rounded-full absolute left-0 top-0"
                        x-on:click="removeImage()">
                        <x-svgicons.xmark-svg-icon />
                    </button>
                </div>
            </div>
            <div>
                <x-secondary-button type="button"
                    x-on:click.prevent="$dispatch('open-modal', { name: 'choose-thumbnail'})">
                    {{ __('Choose thumbnail more from gallery') }}
                </x-secondary-button>
            </div>
        </div>

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

    <div>
        @include('livewire.admin.brand.image-gallery-options')
        @include('components.image-preview-modal')
    </div>
</div>




@script
    <script>
        Alpine.data('selectedImageComponent', () => {
            return {
                selectedImage: @json($brandImage) || {
                    'id': 0,
                    'image_path': ''
                },

                init() {
                    console.log(this.selectedImage);
                },
                removeImage(id) {
                    this.selectedImage = {
                        'id': 0,
                        'image_path': ''
                    };
                },
            }
        });
    </script>
@endscript
