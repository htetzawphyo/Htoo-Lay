<?php

use function Livewire\Volt\{state, layout, usesFileUploads};

layout('livewire.back.admin-sidebar');

usesFileUploads();

state([
    'name' => '',
    'price' => '',
    'category_id' => '',
    'description' => '',
    'image' => '',
    'instock' => []
]);

$save = function() {
    // if(!empty($this->instock[0]) && $this->instock[0] == 1){
    //     
    // }
    dd($this->name, $this->price, $this->category_id, $this->description, $this->image, $this->instock);
};

?>

<div>
    <div class="mb-5">
        <h3 class="text-xl font-medium">Product Add Form</h3>
    </div>

    <form class="w-full" wire:submit="save">
        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-name">
                Name
              </label>
              <input wire:model="name" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-cyan-500" id="product-name" type="text" placeholder="Product Name">
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                Price
              </label>
              <input wire:model="price" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)]  block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-cyan-500" id="product-price" type="number" placeholder="Product Price">
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                Description
              </label>
              <textarea wire:model="description" placeholder="Product Description" type="text" id="1fba1b87-1d34-4cb2-94bd-873d3bdc08ea" rows="4" class="w-full block rounded border dark:border-none dark:bg-gray-200 py-[9px] px-3 pr-4 text-sm focus:border-cyan-500 focus:ring-1 focus:ring-blue-400 focus:outline-none shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)]"></textarea>
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="countries">
                    Select Category
                </label>
                <select wire:model="category_id" id="countries" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a category</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3">              
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Image
                </label>
                <img id="image-preview" src="" alt="Preview Image" class="hidden max-w-full max-h-40 mb-4 rounded-md shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)]"/>
                <input wire:model="image" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-900 focus:outline-none dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="image_input" type="file">
            </div>
        </div>

        <div class="-mx-3 mb-6">
            <div class="w-full px-3 ">
                <input wire:model="instock" id="checked-checkbox" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] cursor-pointer">
                <label for="checked-checkbox" class="ms-2 text-md font-medium text-gray-900 dark:text-gray-700 cursor-pointer">In Stock</label>
            </div>
        </div>

        <button type="submit" class="inline-block rounded bg-cyan-500 text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-cyan-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-cyan-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-cyan-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">Submit</button>
    </form>  
</div>

<script>
    let imageInput = document.querySelector('#image_input');
    let imagePreview = document.querySelector('#image-preview');

    imageInput.addEventListener('change', (e) => {
        imagePreview.classList.remove('hidden');
        
        let selectedFile = e.target.files[0];
        imagePreview.src = URL.createObjectURL(selectedFile);
    })
</script>