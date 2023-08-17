<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class ShowPage extends Component
{
    public $pageInfo;

    public function mount($slug)
    {
        $this->pageInfo = Page::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.show-page')
            ->extends('layouts.app');
    }
}
