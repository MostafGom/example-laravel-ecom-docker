<x-app-layout>
    {{-- <livewire:admin.product.product-form [$product] /> --}}
    @livewire('admin.brand.brand-form', ['brand' => $brand])
</x-app-layout>
