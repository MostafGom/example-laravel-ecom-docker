@props(['image', 'xBindClass', 'clickAction', 'postfixId' => '', 'width' => 'w-[150px]', 'height' => 'h-[150px]'])

<x-modal wire:ignore.self name="preview-image-modal"
    position="absolute top-[50%] left-[50%] translate-y-[-50%] translate-x-[-50%] p-16">

    <div x-data="{ imgSrc: null, originalName: null }"
        x-on:open-modal.window="imgSrc = $event.detail.imgSrc;originalName = $event.detail.originalName" class="p-6"
        x-on:close-view-image-modal.window="show=false">

        <img x-bind:src="`${imgSrc}`" alt="img view" class="w-full">
        <p x-text="`Original file name : ${originalName}`" class="dark:text-white my-4"></p>
        <x-secondary-button x-on:click.prevent="$dispatch('close')" class="mt-4">
            {{ __('close') }}
        </x-secondary-button>
    </div>

</x-modal>
