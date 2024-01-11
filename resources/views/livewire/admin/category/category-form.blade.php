<div x-data="selectedImageComponent" x-init="$watch('selectedImage', (val) => {
    console.log(val);
    $wire.categoryImage = selectedImage
    $wire.category.image_id = selectedImage.id
});">
    <form wire:submit.prevent="addCategory">
        @csrf
        <div class="grid grid-cols-1 gap-2 divide-y">

            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="name" class="font-bold text-lg">Name</label>
                <input type="text" name="name" class="form-input px-4 py-3 rounded text-gray-800" placeholder=""
                    wire:model='category.name'>

                <x-input-error :messages="$errors->get('category.name')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="slug" class="font-bold text-lg">Slug</label>
                <input type="text" name="slug" class="form-input px-4 py-3 rounded text-gray-800"
                    wire:model='category.slug'>

                <x-input-error :messages="$errors->get('category.slug')" class="mt-2" />
            </div>


            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="description" class="font-bold text-lg">Description</label>
                <textarea name="description" class="form-textarea px-4 py-3 rounded text-gray-800 h-[170px]"
                    wire:model='category.description'></textarea>

                <x-input-error :messages="$errors->get('category.description')" class="mt-2" />
            </div>

            {{-- SEO FIELDS --}}
            <div class="h-8 py-12">
                <h3 class="text-2xl">SEO Fields:</h3>
            </div>


            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="meta_title" class="font-bold text-lg">meta_title</label>
                <input type="text" name="meta_title" class="form-input px-4 py-3 rounded text-gray-800"
                    wire:model='category.meta_title'>

                <x-input-error :messages="$errors->get('category.meta_title')" class="mt-2" />
            </div>


            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="meta_keyword" class="font-bold text-lg">meta_keyword</label>
                <input type="text" name="meta_keyword" class="form-input px-4 py-3 rounded text-gray-800"
                    wire:model='category.meta_keyword'>

                <x-input-error :messages="$errors->get('category.meta_keyword')" class="mt-2" />
            </div>


            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="meta_description" class="font-bold text-lg">meta_description</label>
                <textarea name="meta_description" class="form-textarea px-4 py-3 rounded text-gray-800"
                    wire:model='category.meta_description'></textarea>

                <x-input-error :messages="$errors->get('category.meta_description')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 gap-4 py-8">
                <label for="is_active" class="font-bold text-lg">Status</label>
                <input type="checkbox" name="is_active" class="form-checkbox rounded text-pink-500"
                    wire:model="category.is_active" {{ $category->is_active ? 'checked' : '' }} />

                <x-input-error :messages="$errors->get('category.is_active')" class="mt-2" />
            </div>


            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            {{-- CATEGORY IMAGE --}}
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="brand_id"
                    :value="__('Category Thumbnail:')" />
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
                    <a href="{{ route('admincategory') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-primary-button>


            </div>
        </div>
    </form>

    <div>
        @include('livewire.admin.category.image-gallery-options')
        @include('components.image-preview-modal')
    </div>


</div>


@script
    <script>
        Alpine.data('selectedImageComponent', () => {
            return {
                selectedImage: @json($categoryImage[0]) || {
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
