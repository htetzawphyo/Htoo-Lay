<?php

use function Livewire\Volt\{state};

//

?>

<div>
{{-- @livewire('dashboard') --}}

</div>

@script
<script>
    const toggleBtn = document.querySelector('#product-toggle');
    const dropdownMenu = document.querySelector('#dropdown-product');
    const upIcon = document.querySelector('#product-up-icon');
    const downIcon = document.querySelector('#product-down-icon');

    toggleBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
        upIcon.classList.toggle('hidden');
        downIcon.classList.toggle('hidden');
    });
</script>
@endscript