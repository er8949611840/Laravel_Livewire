<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class Pages extends Component
{
    public $pages;
    public $updatePage = false;
    public $addPage = false;

    public function render()
    {
        $this->pages = Page::GetOnlyParent()->with('children')->get();

        return view('livewire.pages');
    }
}
