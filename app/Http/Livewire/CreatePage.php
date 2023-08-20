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
    public $updateMode = false;
    public $pageId = null;
    public $deleteId = null;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'slug' => 'required',
    ];

    public function render()
    {
        $this->parentPages = Page::GetOnlyParent()->with('children')->get();

        return view('livewire.create-page', ['pages' => Page::with('parent')->paginate(10)])->extends('layouts.app');
    }

    public function resetFields()
    {
        $this->title = '';
        $this->slug = '';
        $this->content = '';
        $this->page_id = null;
    }

    public function storePost()
    {
        $this->validate();
        try {
            if (empty($this->page_id)) {
                $this->page_id = null;
            }
            $page = new Page();
            $page->title = $this->title;
            $page->content = $this->content;
            $page->slug = str()->slug($this->slug);
            $page->page_id = $this->page_id;
            if ($page->save()) {
                session()->flash('success', 'Page Has been created successfully.');
                $this->resetFields();

                return to_route('create.page');
            } else {
                throw new \Exception('Something went wrong while creating page');
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong while creating page');
            $this->resetFields();
        }
    }

    public function cancelPost()
    {
        $this->updateMode = false;
        $this->resetFields();
    }

    public function edit($id)
    {
        $pageValue = Page::findOrFail($id);
        $this->pageId = $pageValue->id;
        $this->title = $pageValue->title;
        $this->slug = $pageValue->slug;
        $this->content = $pageValue->content;
        $this->page_id = $pageValue->page_id;
        $this->updateMode = true;
    }

    public function updatePage()
    {
        $this->validate();
        try {
            if (empty($this->page_id)) {
                $this->page_id = null;
            }
            $payload = [
                'title' => $this->title,
                'slug' => str()->slug($this->slug),
                'content' => $this->content,
                'page_id' => $this->page_id,
            ];
            Page::whereId($this->pageId)->update($payload);
            session()->flash('success', 'Page Updated Successfully!!');
            $this->resetFields();
            $this->updateMode = false;

            return to_route('create.page');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Page::find($this->deleteId)->delete();
            session()->flash('success', 'Page deleted Successfully!!');

            return to_route('create.page');
        } else {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
}
