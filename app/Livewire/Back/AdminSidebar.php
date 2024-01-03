<?php

namespace App\Livewire\Back;

use Livewire\Component;

class AdminSidebar extends Component
{
    public $content;
    
    public function render()
    {
        return view('livewire.back.admin-sidebar');
    }
}
