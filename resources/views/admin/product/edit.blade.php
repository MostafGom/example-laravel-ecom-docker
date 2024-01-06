<x-app-layout>
    {{-- <livewire:admin.product.product-form [$product] /> --}}
    @livewire('admin.product.product-form', ['product' => $product])
</x-app-layout>
