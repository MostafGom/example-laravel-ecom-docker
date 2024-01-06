<div class="mt-24 bg-gray-300">
    <div class="bg-white dark:bg-gray-300 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
                {{ __('Choose Category Image ( You can only assign one image )') }}
            </h2>
            <x-primary-button class="dark:bg-gray-400" x-data="" type="button"
                x-on:click.prevent="$dispatch('open-modal', { name: 'add-image-modal'})">
                {{ __('Add images to gallery') }}
            </x-primary-button>
        </div>
    </div>

    @if (session('message'))
        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                <p class="font-bold">{{ session('message') }}</p>
            </div>
        </div>
    @endif
    <div x-data="{ selectedImage: {{ $category->image_id ?? 0 }} || 0 }" x-init="console.log(selectedImage);
    $watch('selectedImage', (val) => {
        console.log(val);
        $wire.category.image_id = selectedImage;
    })" class="pt-16">


        <div class="flex gap-4 justify-center items-center  flex-wrap">
            @foreach ($imagesInLibrary as $image)
                <div x-data="{ ifSelected: selectedImage == {{ $image->id }} }">
                    <x-image-select-element :image="$image"
                        xBindClass="(selectedImage == {{ $image->id }}) ? 'selected border-red-600 border-[0.25rem] p-1' : 'p-2'"
                        clickAction="(selectedImage == {{ $image->id }}) ? (
                            selectedImage = null,
                            ifSelected = false
                        ) : (
                            selectedImage={{ $image->id }} ,
                            ifSelected = true
                        );"
                        data-id="{{ $image->id }}-allimgs" />

                </div>
            @endforeach

        </div>

        <div class="max-w-7xl mx-auto bg-white mt-4" x-data="">

            @if ($imagesInLibrary->hasPages())
                <div class="bg-white p-2 mt-8 font-bold">
                    {{ $imagesInLibrary->links() }}
                </div>
            @endif

        </div>
    </div>

</div>
