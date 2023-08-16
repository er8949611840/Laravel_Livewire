<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPage extends Component
{
    public function render()
    {
        return view('livewire.show-page')
            ->extends('layouts.app');
    }
}
