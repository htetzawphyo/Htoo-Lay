<?php

use App\Models\Category;
use function Livewire\Volt\{state, layout, with, usesPagination};

layout('livewire.back.admin-sidebar');

usesPagination();

with(fn () => ['categories' => Category::paginate(10)]);

?>

<div>
    <div class="mb-5">
        <h3 class="text-xl font-medium">Category List</h3>
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
                        <th scope="col" class="px-6 py-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)                        
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $categories->firstItem() + $key }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $category->name }}</td>
                                <td class="flex items-center px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    {{ $categories->withQueryString()->links() }}
</div>