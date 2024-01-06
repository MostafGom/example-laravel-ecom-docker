@props(['image', 'xBindClass', 'clickAction', 'postfixId' => ''])
<div wire:key="{{ $image->id }}-{{ $image->image_path }}-{{ $postfixId }}"
    class="block group rounded-lg bg-slate-300 relative" x-bind:class="{{ $xBindClass }}">
    <img class="w-[150px] h-[150px] object-contain group-[.selected]:border-red-600 " :key="{{ $image->id }}"
        src="{{ $image->image_path }}" alt="{{ $image->original_name }}" @click="{{ $clickAction }}"
        data-id="{{ $image->id }}">
    <x-svgicons.checkbox-svg-icon size='8' color='red'
        class="absolute left-1 top-1 hidden group-[.selected]:block" />

    <x-secondary-button class="mt-2" x-data="" type="button"
        x-on:click.prevent="$dispatch('open-modal', { name: 'preview-image-modal',imgSrc:'{{ $image->image_path }}',originalName:'{{ $image->original_name }}'})">
        {{ __('preview') }}
    </x-secondary-button>
</div>
{{-- @props(['image', 'xBindClass', 'clickAction', 'postfixId' => ''])
<div wire:key="{{ $image['id'] }}-{{ $image['image_path'] }}-{{ $postfixId }}"
    class="block group rounded-lg bg-slate-300 relative" x-bind:class="{{ $xBindClass }}">
    <img class="w-[150px] h-[150px] object-contain group-[.selected]:border-red-600 " :key="{{ $image['id'] }}"
        src="{{ $image['image_path'] }}" alt="imagealt" @click="{{ $clickAction }}"
        data-id="{{ $image['id'] }}">
    <x-svgicons.checkbox-svg-icon size='8' color='red'
        class="absolute left-1 top-1 hidden group-[.selected]:block" />

    <x-secondary-button class="mt-2" x-data="" type="button"
        x-on:click.prevent="$dispatch('open-modal', { name: 'preview-image-modal',imgSrc:'{{ $image['image_path'] }}',originalName:'{{ $image['original_name'] }}'})">
        {{ __('preview') }}
    </x-secondary-button>
</div> --}}


{{-- <div wire:key="{{ $image->id }}-{{ $image->image_path }}"
                class="block group rounded-lg bg-slate-300 relative"
                x-bind:class="$wire.productImages.includes({{ $image->id }}) ?
                    'selected border-red-600 border-[0.25rem] p-1' : 'p-2'">
                <img class="w-[150px] h-[150px] object-contain group-[.selected]:border-red-600 "
                    :key="{{ $image->id }}" src="{{ $image->image_path }}" alt="imagealt"
                    @click="$wire.productImages.includes({{ $image->id }}) ? $wire.productImages = $wire.productImages.filter(id => id !== {{ $image->id }}) : $wire.productImages.push({{ $image->id }});console.log($wire.productImages)"
                    data-id="{{ $image->id }}">
                <x-svgicons.checkbox-svg-icon size='8' color='red'
                    class="absolute left-1 top-1 hidden group-[.selected]:block" />

                <x-secondary-button class="mt-2" x-data="" type="button"
                    x-on:click.prevent="$dispatch('open-modal', { name: 'preview-image-modal',imgSrc:'{{ $image['image_path'] }}',originalName:'{{ $image['original_name'] }}'})">
                    {{ __('preview') }}
                </x-secondary-button>
            </div> --}}
