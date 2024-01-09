<?php

use App\Models\Product;
use App\Models\Discount;
use function Livewire\Volt\{state, layout, with, usesPagination, rules};

layout('livewire.back.admin-sidebar');

usesPagination();

state([
    'products' => [],
    'id' => '',
    'name' => '',
    'price' => '',
    'searchData' => '',
    'discount_amount' => ''
]);

rules([
    'discount_amount' => ['required', 'numeric'],
]);

$search = function() {
    if($this->searchData){
        $this->products = Product::with('category')
                            ->where('name', 'like', '%' . $this->searchData . '%')
                            ->orWhere('product_code', 'like', '%' . $this->searchData . '%')->paginate(10)->items();
    }else{
        $this->products = [];
    }
};

$selectProdcut = function($id) {
    $product = Product::find($id);

    $this->id = $id;
    $this->name = $product->name . ' - ' . $product->product_code;
    $this->price = $product->price;
    $this->discount_amount = $product->discount->discount_amount ?? '';

    $this->searchData = '';
    $this->products = [];
};

$save = function() {
    $this->validate();

    Discount::updateOrCreate(
        ['product_id' => $this->id],
        ['discount_amount' => $this->discount_amount]
    );

    $this->redirect("/admin/products", navigate: true);
}

?>

<div>
    <div class="mb-5">
        <h3 class="text-xl font-medium">Discount Add Form</h3>
    </div>

    <div class="flex justify-start">
        <div class="relative mb-4 flex w-2/4 max-sm:w-full flex-wrap items-stretch">
            <input wire:model.live.debounce.1000ms="searchData" wire:input.debounce.1000ms="search" type="search" class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-700 dark:placeholder:text-gray-500 dark:focus:border-primary"
            placeholder="Search product.."/>

            <!--Search button-->
            {{-- <button class="relative z-[2] flex items-center rounded-r bg-gray-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg"
            type="button"
            id="button-addon1"
            data-te-ripple-init
            data-te-ripple-color="light">
            <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400"></i>
            </button> --}}

            <!-- Search Results -->
            @if ($products)         
                <div class="absolute top-full left-0 max-h-64 bg-gray-500 w-full z-50 overflow-y-scroll">
                    @foreach ($products as $product)                        
                        <div wire:click="selectProdcut({{ $product->id }})" class="bg-gray-500 ps-5 py-2 text-md text-gray-900 hover:bg-gray-700 cursor-pointer">
                            <div>
                                <span class="font-semibold">{{ $product->name }} - [{{ $product->product_code }}]</span> _ 
                                <span class="text-gray-800 font-semibold">{{ $product->price }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
   
    <form class="w-full" wire:submit="save">
        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-name">
                    Name
                </label>
                <input wire:model="name" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-cyan-500" id="product-name" type="text" placeholder="Product Name" readonly>
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                    Normal Price
                </label>
                <input wire:model="price" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)]  block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-cyan-500" id="product-price" type="number" placeholder="Product Price" readonly>
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                    Discount Amount
                </label>
                <input wire:model="discount_amount" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)]  block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-cyan-500" id="product-price" type="number" placeholder="Product Price">
                <div class="text-red-600 text-sm mb-3">
                    @error('discount_amount') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="inline-block rounded bg-cyan-500 text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-cyan-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-cyan-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-cyan-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">Submit</button>
    </form> 
</div>
