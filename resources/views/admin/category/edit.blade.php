<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Category') }}
            </h2>

            {{-- <a href="{{ route('admincategorycreate') }}" >
                <x-primary-button>
                    {{ __('Add Category') }}
                </x-primary-button>
            </a> --}}

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('admincategoryupdate', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="grid grid-cols-1 gap-2 divide-y">

                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="name" class="font-bold text-lg">Name</label>
                            <input type="text" value="{{ $category->name }}" name="name"
                                class="form-input px-4 py-3 rounded text-gray-800" placeholder=""
                                value="{{ old('name') }}">

                            @error('name')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="slug" class="font-bold text-lg">Slug</label>
                            <input type="text" name="slug" class="form-input px-4 py-3 rounded text-gray-800"
                                value="{{ $category->slug }}">

                            @error('slug')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="description" class="font-bold text-lg">Description</label>
                            <textarea name="description" class="form-textarea px-4 py-3 rounded text-gray-800 h-[170px]">{{ $category->description }}</textarea>

                            @error('description')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="image" class="font-bold text-lg">Image</label>
                            <input type="file" name="image" class="form-input px-4 py-3 rounded text-gray-800">

                            <img src="{{ asset('/uploads/category/' . $category->image) }}" alt="Categroy Image"
                                class="w-[300px] d-block">
                            @error('image')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- SEO FIELDS --}}
                        <div class="h-8 py-12">
                            <h3 class="text-2xl">SEO Fields:</h3>
                        </div>


                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="meta_title" class="font-bold text-lg">meta_title</label>
                            <input type="text" name="meta_title" class="form-input px-4 py-3 rounded text-gray-800"
                                value="{{ $category->meta_title }}">

                            @error('meta_title')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="meta_keyword" class="font-bold text-lg">meta_keyword</label>
                            <input type="text" name="meta_keyword" class="form-input px-4 py-3 rounded text-gray-800"
                                value="{{ $category->meta_keyword }}">

                            @error('meta_keyword')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="meta_description" class="font-bold text-lg">meta_description</label>
                            <textarea name="meta_description" class="form-textarea px-4 py-3 rounded text-gray-800">{{ $category->meta_description }}</textarea>

                            @error('meta_description')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 py-8">
                            <label for="is_active" class="font-bold text-lg">Status</label>
                            <input type="checkbox" name="is_active" class="form-checkbox rounded text-pink-500"
                                {{ $category->is_active == 1 ? 'checked' : '' }} />

                            @error('is_active')
                                <p class="bg-red-600 text-white p-1 font-bold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols gap-4 py-8 ">
                            <x-primary-button class="w-28 flex justify-center font-bold">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
