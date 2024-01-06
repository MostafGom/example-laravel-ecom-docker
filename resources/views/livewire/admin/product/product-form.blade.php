<div>
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
            <div>
                <div class="fullwidthselect2" wire:ignore>
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
            <div>
                <div class="fullwidthselect2" wire:ignore>
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

    @include('livewire.admin.product.image-gallery-options')

    @include('components.image-preview-modal')
    @include('components.add-image-modal')

    @script
        <script>
            console.log('live wire is here edit')
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

            })
        </script>
    @endscript

</div>
