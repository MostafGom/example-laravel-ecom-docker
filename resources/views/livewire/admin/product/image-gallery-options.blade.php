{{-- START IMAGE LIBRARY MODAL --}}
<x-modal maxWidth="80percent" height="h-full" wire:ignore.self name="choose-from-library" :show="$errors->imageAddition->isNotEmpty()" focusable>
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
<x-modal maxWidth="80percent" height="h-full" wire:ignore.self name="choose-thumbnail" :show="$errors->imageAddition->isNotEmpty()" focusable>
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
