<div class="mt-24 bg-white">
    <div class="bg-white dark:bg-gray-300 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
                {{ __('Choose Product Images') }}
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
    <div x-data="selectedImagesComponent" class="">
        <div class="flex gap-4 justify-center items-center  flex-wrap my-4">
            <template x-for="image in selectedImages" :key="image.id">
                <div>
                    <div class="relative p-4 rounded-lg bg-gray-100">
                        <img class='w-[150px] h-[150px] object-contain' :src="image.image_path" alt="imagealt">
                        <button type='button' class="bg-red-400 rounded-lg absolute left-0 top-0"
                            x-on:click="removeImage(image.id)">
                            <x-svgicons.xmark-svg-icon />
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <div class="h-[50px]"></div>

        <div class="flex gap-4 justify-center items-center  flex-wrap">
            @foreach ($imagesInLibrary as $image)
                <div x-data="">
                    <x-image-select-element :image="$image"
                        xBindClass="(selectedImages.findIndex(img => {{ $image->id }} == img.id) > -1) ? 'selected border-red-600 border-[0.25rem] p-1' : 'p-2'"
                        clickAction="(selectedImages.findIndex(img => {{ $image->id }} == img.id) > -1) ? (
                            selectedImages = selectedImages.filter(img => {{ $image->id }} !== img.id)
                        ) : (
                            selectedImages.push({!! $image->toJson() !!})
                        );"
                        data-id="{{ $image->id }}-allimgs" />

                </div>
            @endforeach

        </div>
    </div>

    <div class="h-[20px]"></div>


    <div class="max-w-7xl mx-auto bg-white p-4" x-data="">
        @if ($imagesInLibrary->hasPages())
            <div class="bg-white p-2 mt-8 font-bold">
                {{ $imagesInLibrary->links() }}
            </div>
        @endif
    </div>

</div>
