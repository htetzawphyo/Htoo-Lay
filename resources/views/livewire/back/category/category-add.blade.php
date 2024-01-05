<?php

use function Livewire\Volt\{state, layout, rules};

layout('livewire.back.admin-sidebar');

state([
  'name' => ''
]);

rules([
    'name' => ['required']
]);

$save = function() {
  $this->validate();

  Category::create([
        "name" => $this->name
  ]);

  $this->redirect("/admin/categories", navigate: true);
}

?>

<div>
    <div class="mb-5">
        <h3 class="text-xl font-medium">Category Add Form</h3>
    </div>

    <form class="w-full" wire:submit="save">
        <div class="-mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="category-name">
                Name
              </label>
              <input wire:model="name" class="shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-cyan-500" id="category-name" type="text" placeholder="Category Name">
              <div class="text-red-600 text-sm mb-3">
                  @error('name') {{ $message }} @enderror
              </div>
            </div>
        </div>

        <button type="submit" class="inline-block rounded bg-cyan-500 text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-cyan-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-cyan-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-cyan-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">Submit</button>
    </form>  
</div>