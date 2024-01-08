<?php

use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state};

$logout = function () {
    Auth::logout();
    $this->redirect('/', navigate: true);
}

?>

<div>
    <button wire:click="logout" type="button" id="category-toggle" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
        <i class="fa-solid fa-arrow-right-from-bracket text-gray-500"></i>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Logout</span>
    </button>
</div>
