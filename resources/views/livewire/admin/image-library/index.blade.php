<div>
    @if (session('message'))
        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                <p class="font-bold">{{ session('message') }}</p>
            </div>
        </div>
    @endif
    <div>
        <div class="flex">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.500ms='search'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                    placeholder="Search" required="">
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-8">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center gap-4 flex-wrap">

            @forelse ($imagesInLibrary as $image)
                <div class="bg-slate-300 p-1 rounded-lg">

                    <img class="w-[200px] h-[200px] object-contain" src="{{ $image['image_path'] }}" alt="" />
                    <div class="mx-2">

                        <x-danger-button wire:click="deleteImage('{{ $image['id'] }}')" x-data=""
                            x-on:click.prevent="$dispatch('open-modal', { name: 'confirm-image-deletion'})"
                            class="p-0 rounded-full">
                            {{-- {{ __('Delete') }} --}}
                            <x-svgicons.delete-svg-icon size='5' />
                        </x-danger-button>

                        <x-secondary-button x-data="" class="p-0 rounded-full"
                            x-on:click.prevent="$dispatch('open-modal', { name: 'preview-image-modal',imgSrc:'{{ $image['image_path'] }}',originalName:'{{ $image['original_name'] }}'})">
                            {{-- {{ __('View Image') }} --}}
                            <x-svgicons.eye-svg-icon size='5' />
                        </x-secondary-button>
                    </div>
                </div>
            @empty
                <h5>No Results</h5>
            @endforelse

        </div>
        @if ($imagesInLibrary->hasPages())
            <div class="bg-white p-2 mt-8">
                {{ $imagesInLibrary->links() }}
            </div>
        @endif

        {{-- @include('livewire.admin.image.edit-image-modal-form') --}}
        @include('components.add-image-modal')
        @include('components.image-preview-modal')


        @include('components.delete-confirm-modal', [
            'name' => 'confirm-image-deletion',
            'errorDeletion' => 'imageDeletion',
            'destroyMethod' => 'destroyImage',
            'closeEvent' => 'close-delete-image-modal',
            'confirmationMessage' => 'Are you sure you want to delete your image?',
            'confirmationWarningMessage' =>
                'Once your image is deleted, all of its resources and data will be permanently deleted.',
        ])
    </div>

</div>
