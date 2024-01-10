@props(['image', 'xBindClass', 'clickAction', 'postfixId' => '', 'width' => 'w-[150px]', 'height' => 'h-[150px]'])
<div wire:key="{{ $image->id }}-{{ $image->image_path }}-{{ $postfixId }}"
    class="group rounded-lg bg-slate-200 bg-opacity-50 relative flex flex-col justify-between"
    x-bind:class="{{ $xBindClass }}">
    <img class="{{ $width . ' ' }} object-contain group-[.selected]:border-red-600 mx-auto" :key="{{ $image->id }}"
        @click="{{ $clickAction }}" src="{{ $image->image_path }}" alt="{{ $image->original_name }}"
        data-id="{{ $image->id }}">
    <x-svgicons.checkbox-svg-icon size='8' color='red'
        class="absolute left-1 top-1 hidden group-[.selected]:block" />

    <x-custom-button px="px-1" py="py-1" width="w-fit" x-data="" type="button"
        x-on:click.prevent="$dispatch('open-modal', { name: 'preview-image-modal',imgSrc:'{{ $image->image_path }}',originalName:'{{ $image->original_name }}'})">
        <x-svgicons.eye-svg-icon size='5' />
    </x-custom-button>
</div>
