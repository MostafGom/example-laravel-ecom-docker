<div x-data="selectedImagesComponent" x-init="console.log(selectedImages);
$watch('selectedImages', (val) => {
    console.log('val');
    console.log(val);
    $wire.productImages = selectedImages
});
$watch('selectedThumbnail', (val) => {
    console.log(val);
    $wire.product.thumbnail = selectedThumbnail
});">

    <form wire:submit.prevent="addProduct" class="p-6 bg-gray-900 dark:bg-white shadow-maintomato rounded-2xl">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-900">
            {{ __('Add product') }}
        </h2>
        <hr class="my-6">
        <div class="grid gap-10 mb-6 md:grid-cols-2">

            {{-- NAME --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="name" :value="__('Name')" />
                <input class="rounded-xl block mt-6 w-full text-white dark:text-gray-800" type="text"
                    wire:model="product.name" id="name" />
                <x-input-error :messages="$errors->get('product.name')" class="mt-2" />
            </div>

            {{-- SLUG --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="slug"
                    :value="__('Slug')" />
                <input class="rounded-xl block mt-6 w-full text-white dark:text-gray-800" type="text"
                    wire:model="product.slug" />
                <x-input-error :messages="$errors->get('product.slug')" class="mt-2" />
            </div>

            {{-- PRICE --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="price"
                    :value="__('Price')" />
                <input class="rounded-xl block mt-6 w-full text-white dark:text-gray-800" type="number" step=".01"
                    wire:model="product.price" />
                <x-input-error :messages="$errors->get('product.price')" class="mt-2" />
            </div>
            {{-- SKU --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="sku"
                    :value="__('SKU')" />
                <input class="rounded-xl block mt-6 w-full text-white dark:text-gray-800" type="text"
                    wire:model="product.sku" />
                <x-input-error :messages="$errors->get('product.sku')" class="mt-2" />
            </div>

            {{-- SHORT DESCRIPTION --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="short_description"
                    :value="__('Short Description')" />
                <textarea class="resize-none h-[200px] block mt-6 w-full rounded-xl text-white dark:text-gray-800" type="text"
                    wire:model="product.short_description"></textarea>
                <x-input-error :messages="$errors->get('product.short_description')" class="mt-2" />
            </div>

            {{-- LONG DESCRIPTION --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="long_description"
                    :value="__('Long Description')" />
                <textarea class="resize-none h-[200px] block mt-6 w-full rounded-xl text-white dark:text-gray-800" type="text"
                    wire:model="product.long_description"></textarea>
                <x-input-error :messages="$errors->get('product.long_description')" class="mt-2" />
            </div>

            {{-- BRAND --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="brand_id"
                    :value="__('Choose Brand')" />
                <div class="fullwidthselect2 mt-2" wire:ignore>
                    <select wire:model="product.brand_id" class="w-full" id="brandsselect"
                        data-placeholder="Choose brand" x-on:change="console.log($event)">
                        <option></option>
                        @foreach ($allBrands as $brand)
                            <option wire:key="{{ $brand->id }}-{{ $brand->name }}" value="{{ $brand->id }}">
                                {{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('product.brand_id')" class="mt-2" />
            </div>

            {{-- CATEGORIES --}}
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="brand_id"
                    :value="__('Choose Categories')" />
                <div class="fullwidthselect2 mt-2" wire:ignore>
                    <select wire:model="productCategoriesIds" multiple class="w-full" id="categoriesselect"
                        data-placeholder="Choose categories" x-on:change="console.log('categories on change')">
                        <option></option>
                        @foreach ($allCategories as $category)
                            <option wire:key="{{ $category->id }}-{{ $category->name }}" value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        {{-- IMAGES --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="brand_id" :value="__('Selected Images:')" />
            <p x-text="selectedImages.length ? '' : 'No Images Selected' " class="text-center text-red-600"></p>

            <div class="flex gap-4 justify-start items-center  flex-wrap my-4">
                <template x-for="image in selectedImages" :key="image.id">
                    <div>
                        <div class="relative p-4 rounded-lg bg-gray-100">
                            <img class='w-[100px] h-[100px] object-contain' :src="image.image_path" alt="imagealt">
                            <button type='button' class="bg-red-600 rounded-full absolute left-0 top-0"
                                x-on:click="removeImage(image.id)">
                                <x-svgicons.xmark-svg-icon />
                            </button>
                        </div>
                    </div>
                </template>
            </div>
            <div>
                <x-secondary-button type="button"
                    x-on:click.prevent="$dispatch('open-modal', { name: 'choose-from-library'})">
                    {{ __('Choose more from gallery') }}
                </x-secondary-button>
            </div>
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        {{-- Thumbnail --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <x-input-label class="font-bold text-xl text-white dark:text-gray-800" for="brand_id" :value="__('Product Thumbnail:')" />
            <p x-show="selectedThumbnail.id == 0" x-text="'No Thumbnail Selected'" class="text-center text-red-600"></p>

            <div class="flex gap-4 justify-start items-center  flex-wrap my-4">
                <div x-cloak x-show="selectedThumbnail.image_path != ''" class="relative p-4 rounded-lg bg-gray-100">
                    <img class='w-[100px] h-[100px] object-contain' :src="selectedThumbnail.image_path" alt="imagealt">
                    <button type='button' class="bg-red-600 rounded-full absolute left-0 top-0"
                        x-on:click="removeThumbnail()">
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

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">&nbsp;</p>
            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button type="submit">
                    {{ __('Create') }}
                </x-secondary-button>

                <x-primary-button type="button">
                    <a href="{{ route('adminproduct') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-primary-button>
            </div>
        </div>
    </form>




    {{-- START IMAGE LIBRARY MODAL --}}
    <x-modal maxWidth="80percent" height="h-full" wire:ignore.self name="choose-from-library" :show="$errors->imageAddition->isNotEmpty()"
        focusable>
        <div class="p-4 h-full flex flex-col justify-between overflow-y-auto gap-4">
            <div class=" grid grid-cols-3 md:grid-cols-5 gap-8 justify-center items-stretch ">
                @foreach ($imagesInLibrary as $image)
                    <x-image-select-element width="w-[100px]" :image="$image"
                        xBindClass="(selectedImages.findIndex(img => {{ $image->id }} == img.id) > -1) ? 'selected border-red-600 border-[0.25rem] p-1' : 'p-2'"
                        clickAction="(selectedImages.findIndex(img => {{ $image->id }} == img.id) > -1) ? (
                        selectedImages = selectedImages.filter(img => {{ $image->id }} !== img.id)
                    ) : (
                        selectedImages.push({!! $image->toJson() !!})
                    );"
                        data-id="{{ $image->id }}-allimgs" />
                @endforeach
            </div>
            <div class="rounded-xl mx-auto bg-white bg-opacity-50 w-full" x-data="">
                @if ($imagesInLibrary->hasPages())
                    <div class="rounded-xl  p-2 font-bold ">
                        {{ $imagesInLibrary->links() }}
                    </div>
                @endif
            </div>
            <div class="rounded-xl mx-auto flex justify-end w-full" x-data="">
                <x-primary-button type="button" x-on:click.prevent="$dispatch('close')">
                    {{ __('Done') }}
                </x-primary-button>

            </div>
        </div>
    </x-modal>
    {{-- END IMAGE LIBRARY MODAL --}}

    {{-- START Thumbnail MODAL --}}
    <x-modal maxWidth="80percent" height="h-full" wire:ignore.self name="choose-thumbnail" :show="$errors->imageAddition->isNotEmpty()"
        focusable>
        <div class="p-4 h-full flex flex-col justify-between overflow-y-auto gap-4">
            <div class=" grid grid-cols-3 md:grid-cols-5 gap-8 justify-center items-stretch ">
                @foreach ($imagesInLibrary as $image)
                    <x-image-select-element width="w-[100px]" :image="$image"
                        xBindClass="(selectedThumbnail && selectedThumbnail.id == {{ $image->id }}) ? 'selected border-red-600 border-[0.25rem] p-1' : 'p-2'"
                        clickAction="(selectedThumbnail && selectedThumbnail.id == {{ $image->id }}) ? (
                        selectedThumbnail = {'id':0,'image_path':''}
                    ) : (
                        selectedThumbnail = {'id':{{ $image->id }},'image_path':'{{ $image->image_path }}'}
                    );"
                        data-id="{{ $image->id }}-allimgs" />
                @endforeach
            </div>
            <div class="rounded-xl mx-auto bg-white bg-opacity-50 w-full" x-data="">
                @if ($imagesInLibrary->hasPages())
                    <div class="rounded-xl  p-2 font-bold ">
                        {{ $imagesInLibrary->links() }}
                    </div>
                @endif
            </div>
            <div class="rounded-xl mx-auto flex justify-end w-full" x-data="">
                <x-primary-button type="button" x-on:click.prevent="$dispatch('close')">
                    {{ __('Done') }}
                </x-primary-button>

            </div>
        </div>
    </x-modal>
    {{-- END Thumbnail MODAL --}}


    <div>
        {{-- @include('livewire.admin.product.image-gallery-options') --}}
        @include('components.image-preview-modal')
        @include('components.add-image-modal')
    </div>

</div>
@script
    <script>
        Alpine.data('selectedImagesComponent', () => {
            return {
                selectedImages: @json($productImages),
                selectedThumbnail: {!! $product->thumbnail !!} || {
                    'id': 0,
                    'image_path': ''
                },

                init() {
                    console.log(this.selectedImages);
                    console.log(this.selectedThumbnail);
                },
                removeImage(id) {
                    this.selectedImages = this.selectedImages.filter(item => item.id !== id);
                },
                removeThumbnail() {
                    this.selectedThumbnail = {
                        'id': 0,
                        'image_path': ''
                    };
                },
            }
        });

        $(document).ready(function() {
            $('#categoriesselect').select2()
                .on('change', function() {
                    $wire.productCategoriesIds = $('#categoriesselect').val();
                })

            $("#brandsselect").select2()
                .on('change', function() {
                    $wire.product.brand_id = $('#brandsselect').val();
                    console.log($wire.product);
                })
        });
    </script>
@endscript
