<x-modal wire:ignore.self name="product-variant-attribute-form-modal" :show="$errors->variantAddition->isNotEmpty()" focusable>

    <form wire:submit.prevent="saveVariantAttribute" class="p-6"
        x-on:close-product-variant-attribute-form-modal.window="show=false">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 p-6">
            {{ __('Add Product Variant Attribute') }}
        </h2>
        <hr class="my-6">

        {{-- PRODUCT ID --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-white" for="product_id" :value="__('Choose Product')" />
                <div class="fullwidthselect2 mt-2" wire:ignore>
                    <select wire:model="product_id" class="w-full" id="product_id" data-placeholder="Choose Product">
                        <option></option>
                        @foreach ($allProducts as $product)
                            <option wire:key="{{ $product->id }}-{{ $product->name }}" value="{{ $product->id }}">
                                {{ $product->id }}-{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- VARIANT ATTRIBUTES --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label class="font-bold text-xl text-white dark:text-white" for="variant" :value="__('Choose Variant Attribute')" />
                <div class="fullwidthselect2 mt-2" wire:ignore>
                    <select wire:model="variant_attribute_id" class="w-full" id="variant_attribute_id"
                        data-placeholder="Choose Variant">
                        <option></option>
                        @foreach ($allVariantAttributes as $variantAttribute)
                            <option wire:key="{{ $variantAttribute->id }}-{{ $variantAttribute->name }}"
                                value="{{ $variantAttribute->id }}">
                                {{ $variantAttribute->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- PRODUCT VARIANT ATTRIBUTE NAME --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label for="name" :value="__('Product Variant Name')" class="font-bold text-xl text-white dark:text-white" />
                <input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- PRODUCT VARIANT ATTRIBUTE PRICE OVERRIDE  --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label for="price_override" :value="__('Product Variant Price Override')"
                    class="font-bold text-xl text-white dark:text-white" />
                <input id="price_override" class="block mt-1 w-full" type="number" step=".01"
                    wire:model="price_override" />
            </div>
            <x-input-error :messages="$errors->get('price_override')" class="mt-2" />
        </div>

        {{-- PRODUCT VARIANT ATTRIBUTE SKU --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label for="sku" :value="__('Product Variant SKU')" class="font-bold text-xl text-white dark:text-white" />
                <input id="sku" class="block mt-1 w-full" type="text" wire:model="sku" />
            </div>
            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
        </div>

        {{-- PRODUCT VARIANT ATTRIBUTE QUANTITY --}}
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div>
                <x-input-label for="stock_quantity" :value="__('Product Variant Quantity')"
                    class="font-bold text-xl text-white dark:text-white" />
                <input id="stock_quantity" class="block mt-1 w-full" type="number" wire:model="stock_quantity" />
            </div>
            <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
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
