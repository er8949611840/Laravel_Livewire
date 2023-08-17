<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class CreatePage extends Component
{
    public $title;
    public $slug;
    public $content;
    public $parentPages;
    public $page_id = null;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'slug' => 'required',
    ];

    public function render()
    {
        $this->parentPages = Page::GetOnlyParent()->get();

        return view('livewire.create-page')->extends('layouts.app');
    }

    public function resetFields()
    {
        $this->title = '';
        $this->slug = '';
        $this->title = '';
        $this->content = '';
        $this->page_id = null;
    }

    public function storePost()
    {
        $this->validate();
        try {
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong while creating page');
            $this->resetFields();
        }
    }

    public function cancelPost()
    {
    }
}
