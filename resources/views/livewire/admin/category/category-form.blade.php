<div>
    <form wire:submit.prevent="addCategory" x-on:close-add-category-modal.window="show=false">
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


            <div class="grid grid-cols-1 gap-4 py-8">
                @include('livewire.admin.category.image-gallery-options')

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


</div>
