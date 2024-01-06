<?php

use App\Models\Product;
use function Livewire\Volt\{state, layout, with, usesPagination};

layout('livewire.back.admin-sidebar');

usesPagination();

with(fn () => ['products' => Product::with('category')->paginate(10)]);

?>

<div>
    <div class="mb-5">
        <h3 class="text-xl font-medium">Product List</h3>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" class="px-6 py-4">#</th>
                        <th scope="col" class="px-6 py-4">Name</th>
                        <th scope="col" class="px-6 py-4">Price</th>
                        <th scope="col" class="px-6 py-4">Stock</th>
                        <th scope="col" class="px-6 py-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)                        
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $products->firstItem() + $key }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $product->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $product->price }} Ks</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($product->instock)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">In Stock</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Out of Stock</span>
                                    @endif
                                </td>
                                <td class="flex items-center px-6 py-4">
                                    <a href="/admin/products/view/{{ $product->id }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                    wire:confirm="Are you sure you want to delete this product?">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    {{ $products->withQueryString()->links() }}
</div>