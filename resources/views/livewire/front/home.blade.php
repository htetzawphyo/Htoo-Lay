<?php

use App\Models\Product;
use function Livewire\Volt\{state, with, usesPagination};

// state(['products' => fn() => Product::with('category')->get()]);

usesPagination();

state(['search']);

with(fn () => [
    'products' => Product::with('category')
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('product_code', 'like', '%' . $this->search . '%')->paginate(10),
]);

?>

<div class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">
    <!--Nav-->
    <nav id="header" class="w-full z-30 top-0 py-1">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

            <div class="order-1 md:order-2">
                <a class="flex items-center tracking-wide no-underline hover:no-underline font-primary font-bold text-gray-800 text-2xl " href="#">
                    <svg class="fill-current text-violet-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                    </svg>
                    HTOO LAY
                </a>
            </div>

            {{-- <div class="order-2 md:order-3 flex items-center" id="nav-content">

                <a class="inline-block no-underline hover:text-violet-950" href="#">
                    <svg class="fill-current text-violet-800 hover:text-violet-950" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <circle fill="none" cx="12" cy="7" r="3" />
                        <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                    </svg>
                </a>

                <a class="pl-3 inline-block no-underline hover:text-violet-950" href="#">
                    <svg class="fill-current text-violet-800 hover:text-violet-950" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                        <circle cx="10.5" cy="18.5" r="1.5" />
                        <circle cx="17.5" cy="18.5" r="1.5" />
                    </svg>
                </a>

            </div> --}}
        </div>
    </nav>

    <section class="bg-white py-5">

        {{-- <div class="flex gap-2">
            <div class="flex">
                <input type="text" placeholder="Search for the tool you like"
                    class="w-full max-sm:w-full px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500">
                <button type="submit" class="bg-sky-500 text-white rounded-r px-2 md:px-3 py-0 md:py-1">Search</button>
            </div>
            <select id="pricingType" name="pricingType"
                class="w-full md:w-80 h-10 border-2 border-sky-500 focus:outline-none focus:border-sky-500 text-sky-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                <option value="All" selected="">All</option>
                <option value="Freemium">Freemium</option>
                <option value="Free">Free</option>
                <option value="Paid">Paid</option>
            </select>
        </div> --}}

        {{-- Search Form  --}}
        <div class="mb-3 flex justify-center">
            <div class="relative mb-4 flex  flex-wrap items-stretch w-2/4 max-md:w-full mx-2">
                <input wire:model.live.debounce.1000ms="search" type="search" class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-700 dark:placeholder:text-gray-500 dark:focus:border-primary"
                placeholder="Search"/>

                <button class="relative z-[2] flex items-center rounded-r bg-gray-500 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg" type="button">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400"></i>
                </button>
            </div>
        </div>

        {{-- Filter --}}
        {{-- <div class="mb-3">
            <label for="category">Filter</label>
            <select id="category" name="pricingType"
            class="w-2/4 max-md:w-full h-9 mx-2 border-2 border-gray-500 focus:outline-none focus:border-gray-500 text-gray-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                <option value="All" selected="">All</option>
                <option value="Freemium">Freemium</option>
                <option value="Free">Free</option>
                <option value="Paid">Paid</option>
            </select>

            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2 ms-10" for="countries">
                Filter
            </label>
            <select id="countries" class="w-2/12 max-md:w-full h-9 max-lg:ms-10 max-md:mx-2 border-2 border-gray-500 focus:outline-none focus:border-gray-500 text-gray-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                <option value="All" selected="">All</option>
                <option value="Freemium">Freemium</option>
                <option value="Free">Free</option>
                <option value="Paid">Paid</option>
            </select>
        </div> --}}
        
        @if(session()->has('401-message'))
            <div class="flex justify-center">
                <div class="mb-4 rounded-sm bg-red-500 px-6 py-2 text-base text-neutral-200 w-11/12 max-md:w-ful" role="alert">
                    {{ session('401-message') }}
                </div>
            </div>
        @endif
        
        <div>
            {{-- <div class="mb-3 flex justify-start ms-20">
                <select id="pricingType" name="pricingType"
                class="w-2/12 h-9 mx-2 border-2 border-gray-500 focus:outline-none focus:border-gray-500 text-gray-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                    <option value="All" selected="">All</option>
                    <option value="Freemium">Freemium</option>
                    <option value="Free">Free</option>
                    <option value="Paid">Paid</option>
                </select>
            </div> --}}
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">           
                @foreach ($products as $product)                
                    <div class="w-full rounded-lg shadow-lg md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <div>
                            <img class="hover:grow hover:shadow-lg " src="{{asset('storage/product-image/'.$product->image)}}">
                            <div class="pt-3 mb-3 flex items-center justify-between">
                                <p class="text-violet-800 font-primary font-bold">
                                    {{ $product->name }} 
                                    <span class="text-xs text-gray-800"> - {{ $product->product_code }}</span>
                                </p>
                                <p class="pt-1 text-gray-900">{{ $product->price }} Ks</p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <a href="" class="font-primary inline-block rounded bg-violet-500 text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-violet-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-violet-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-violet-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">View Detail</a>
                            @if ($product->instock)                            
                                <span class="bg-green-800 text-red-100 text-xs font-medium me-2 px-2 flex items-center rounded-full ">Instock</span>
                            @else                            
                                <span class="bg-red-800 text-red-100 text-xs font-medium me-2 px-2 flex items-center rounded-full ">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
</div>
