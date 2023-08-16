<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class Pages extends Component
{
    public $pages;

    public function render()
    {
        $this->pages = Page::GetOnlyParent()->get();

        return view('livewire.pages');
    }
}
