<?php

use App\Models\Category;
use function Livewire\Volt\{state, layout, with, usesPagination};

layout('livewire.back.admin-sidebar');

usesPagination();

state(['search']);

with(fn () => ['categories' => Category::where('name', 'like', '%' . $this->search . '%')->paginate(10)]);

$delete = function($id) {
    $category = Category::find($id);
    
    $category->delete();
}

?>

<div>
    <div class="mb-5">
        <h3 class="text-xl font-medium">Category List</h3>
    </div>

    <div class="flex flex-col">

        {{-- Search Form  --}}
        <div class="mb-3 flex justify-start">
            <div class="relative mb-4 flex  flex-wrap items-stretch w-3/4 max-md:w-full">
                <input wire:model.live.debounce.1000ms="search" type="search" class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-700 dark:placeholder:text-gray-500 dark:focus:border-primary"
                placeholder="Search"/>

                <button class="relative z-[2] flex items-center rounded-r bg-gray-500 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg" type="button">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400"></i>
                </button>
            </div>
        </div>

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
                                    <a href="/admin/category/view/{{ $category->id }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                    wire:click="delete({{$category->id}})" wire:confirm="Are you sure you want to delete this category?">
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
    {{ $categories->withQueryString()->links() }}
</div>