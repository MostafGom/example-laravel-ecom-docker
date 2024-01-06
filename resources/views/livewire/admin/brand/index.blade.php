<div>
    @if (session('message'))
        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                <p class="font-bold">{{ session('message') }}</p>
            </div>
        </div>
    @endif
    <div class="max-w-7xl mx-auto">
        <div>
            <section class="mt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex items-center justify-between d p-4">
                            <div class="flex">
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>

                                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('name')">
                                            <x-table-column-head-w-sort-icon :sortColumn="$sortBy" columnName="name"
                                                columnNameToDisplay="Name" :sortDirection="$sortDirection" />

                                        </th>
                                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('slug')">
                                            <x-table-column-head-w-sort-icon :sortColumn="$sortBy" columnName="slug"
                                                columnNameToDisplay="Slug" :sortDirection="$sortDirection" />
                                        </th>
                                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('created_at')">
                                            <x-table-column-head-w-sort-icon :sortColumn="$sortBy" columnName="created_at"
                                                columnNameToDisplay="Created At" :sortDirection="$sortDirection" />
                                        </th>
                                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('updated_at')">
                                            Updated
                                            At</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span>Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr wire:key="{{ $brand->id }}" class="border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $brand->name }}</th>
                                            <td class="px-4 py-3">{{ $brand->slug }}</td>

                                            <td class="px-4 py-3">{{ $brand->created_at }}</td>
                                            <td class="px-4 py-3">{{ $brand->updated_at }}</td>
                                            <td class="px-4 py-3 flex items-center justify-between gap-1">

                                                <a href="{{ route('adminbrandedit', $brand->id) }}">
                                                    <x-secondary-button>
                                                        <x-svgicons.edit-svg-icon size='5' />

                                                    </x-secondary-button>
                                                </a>

                                                <x-danger-button wire:click="deleteBrand('{{ $brand['id'] }}')"
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', { name: 'confirm-brand-deletion'})"
                                                    class="p-0 rounded-full">
                                                    {{-- {{ __('Delete') }} --}}
                                                    <x-svgicons.delete-svg-icon size='5' />
                                                </x-danger-button>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="py-4 px-3">
                            <div class="flex ">
                                <div class="flex space-x-4 items-center mb-3">
                                    <label class="w-32 text-sm font-medium text-gray-900 dark:text-white">Per
                                        Page</label>
                                    <select wire:model.live="perPage"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        @if ($brands->hasPages())
            <div class="bg-white p-2">
                {{ $brands->links() }}
            </div>
        @endif
        <div>

            <div class="">
                @include('components.image-preview-modal')

                @include('components.delete-confirm-modal', [
                    'name' => 'confirm-brand-deletion',
                    'errorDeletion' => 'brandDeletion',
                    'destroyMethod' => 'destroyBrand',
                    'closeEvent' => 'close-delete-brand-modal',
                    'confirmationMessage' => 'Are you sure you want to delete your brand?',
                    'confirmationWarningMessage' =>
                        'Once your brand is deleted, all of its resources and data will be permanently deleted.',
                ])
            </div>
        </div>

    </div>

</div>
