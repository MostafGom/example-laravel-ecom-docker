<x-modal wire:ignore.self name="add-image-modal" :show="$errors->imageAddition->isNotEmpty()" focusable>

    <form wire:submit.prevent="addImage" class="p-6" x-on:close-add-image-modal.window="show=false">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 p-6">
            {{ __('Add image') }}
        </h2>
        <hr class="my-6">
        <div class="grid gap-6 mb-6 md:grid-cols-1 p-6">
            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div>
                    <x-input-label for="" :value="__('Images')" class="font-bol text-2xl" />
                    {{-- <input name="images[]" id="upload{{ $iteration }}" class="block mt-6 w-full text-white"
                        type="file" wire:model="images" multiple
                        accept="image/png, image/jpg, image/jpeg, image/svg+xml" /> --}}
                    <x-file-input accept='image/png, image/jpg, image/jpeg, image/svg+xml'
                        labelMsg="SVG, PNG, JPG or WEBP" id='upload{{ $iteration }}' wireModel="images"
                        multiple='true' classes="mt-4" />

                    @forelse ($errors->get('images.*') as $error)
                        <x-input-error :messages="$error[0]" class="mt-2" />
                        {{-- {{ var_dump($error) }} --}}
                    @empty
                    @endforelse
                    {{-- {{ var_dump($errors->get('images.*')) }} --}}
                </div>
                <!-- Progress Bar -->
                <div x-show="uploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
            <div class="flex text-white overflow-x-auto gap-x-4">

                @foreach ($images as $tempImage)
                    @if (in_array($tempImage->getMimeType(), [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'image/svg',
                            'image/svg+xml',
                        ]))
                        <img class="w-[150px] h-[150px] object-contain rounded-lg"
                            src="{{ $tempImage->temporaryUrl() }}">
                    @else
                        <p>No preview</p>
                    @endif
                @endforeach

            </div>

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
