<?php

use App\Models\Product;
use App\Models\Category;
use function Livewire\Volt\{state, with, usesPagination, mount};

usesPagination();

state([
    'search', 
    'filterId',
]);

with(fn () => [
    'products' => $this->getFilteredProducts(),
]);

$getFilteredProducts = function ()
{
    $query = Product::with('category', 'discount');

    if ($this->filterId) {
        $query->where('category_id', $this->filterId);
    } 
    if($this->search){
        $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('product_code', 'like', '%' . $this->search . '%');
    }

    return $query->orderBy('created_at', 'desc')->paginate(10);
}
?>

<div class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">
    <!--Nav-->
    <nav id="header" class="w-full z-30 top-0 py-1 bg-gray-400">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
            <a href="/" class="flex items-center tracking-wide no-underline hover:no-underline font-primary font-bold text-gray-800 text-2xl ">
                <!-- <i class="fa-solid fa-hand-sparkles fill-current text-violet-800 mr-2"></i> -->
                <img src="/logo.png" alt="logo" class="w-8 rounded-sm mr-2">
                <span class="bg-gradient-to-r from-stone-900 via-violet-500 to-violet-900 text-transparent bg-clip-text">Charming Treasures 20</span>
            </a>
        </div>
    </nav>

    <section class="bg-white py-5">

        {{-- Search Form  --}}
        <div class="mb-3 flex justify-center mx-6">
            <div class="relative mb-4 flex  flex-wrap items-stretch w-2/4 max-md:w-full mx-2">
                <input wire:model.live.debounce.1000ms="search" type="search" class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-700 dark:placeholder:text-gray-500 dark:focus:border-primary"
                placeholder="Search"/>
            </div>
        </div>
        
        @if(session()->has('401-message'))
            <div class="flex justify-center">
                <div class="mb-4 rounded-sm bg-red-500 px-6 py-2 text-base text-neutral-200 w-11/12 max-md:w-ful" role="alert">
                    {{ session('401-message') }}
                </div>
            </div>
        @endif

        <div class="mb-3 ms-3 flex justify-start">
            <select id="filter" wire:model.live="filterId"  name="filter" class="h-9 mx-2 border-2 border-gray-500 focus:outline-none focus:border-gray-500 text-gray-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                <option value="0" selected>All</option>
                @foreach (Category::all() as $category)                        
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-4 max-md:grid-cols-3 max-sm:grid-cols-2 mx-5 gap-5">
            @foreach ($products as $product)
                <div class="rounded-lg shadow-lg p-6 flex flex-col bg-neutral-200">
                    <div>
                        <img class="hover:grow hover:shadow-lg " src="{{asset('storage/product-image/'.$product->image)}}">
                        <div class="pt-3 mb-3 flex flex-col">
                            <p class="text-violet-800 font-primary font-bold">
                                {{ $product->name }} 
                                <span class="text-xs text-gray-800"> - {{ $product->product_code }}</span>
                            </p>
                            <div class="">
                                @if ($product->discount)
                                    <s class="pt-1 text-gray-900 inline-block">{{ $product->price}} Ks</s>
                                    <p class="pt-1 text-red-600 inline-block">{{ $product->price - $product->discount->discount_amount }} Ks</p>
                                @else                                    
                                    <p class="pt-1 text-gray-900">{{ $product->price }} Ks</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        @if ($product->instock)                            
                            <span class="bg-green-800 text-red-100 text-xs font-medium me-2 px-2 flex items-center rounded-full ">Instock</span>
                        @else                            
                            <span class="bg-red-800 text-red-100 text-xs font-medium me-2 px-2 flex items-center rounded-full ">Out of Stock</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        
        <div class="mt-8 mx-5 mb-5">
            {{ $products->withQueryString()->links(data: ['scrollTo' => false]) }}
        </div>
    </section>
</div>
