<div class="">
    <div class="card-body">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($updateMode == true)
            <form>
                <div class="form-group mb-3">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Enter Title" wire:model="title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug:</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        placeholder="Enter Slug" wire:model="slug">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="page_id">Select Parent:</label>
                    <select class="form-control @error('page_id') is-invalid @enderror" id="page_id"
                        wire:model="page_id">
                        <option value="">Root</option>
                        @forelse ($parentPages as $parentpage)
                            <option value="{{ $parentpage->id }}">{{ $parentpage->title }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('page_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="content">Content:</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" wire:model="content"
                        placeholder="Enter Content"></textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button wire:click.prevent="updatePage()" class="btn btn-success btn-block">Update</button>
                    <button wire:click.prevent="cancelPost()" class="btn btn-secondary btn-block">Cancel</button>
                </div>
            </form>
        @else
            <form>
                <div class="form-group mb-3">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Enter Title" wire:model="title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug:</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        placeholder="Enter Slug" wire:model="slug">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="page_id">Select Parent:</label>
                    <select class="form-control @error('page_id') is-invalid @enderror" id="page_id"
                        wire:model="page_id">
                        <option value="">Root</option>
                        @forelse ($parentPages as $parentpage)
                            <option value="{{ $parentpage->id }}">{{ $parentpage->title }}</option>
                            @if ($parentpage->children->isNotEmpty())
                                <optgroup label="{{ $parentpage->title }}">
                                    @forelse ($parentpage->children as $child)
                                        <option value="{{ $child->id }}">{{ $child->title }}</option>
                                    @empty
                                    @endforelse
                                </optgroup>
                            @endif
                        @empty
                        @endforelse
                    </select>
                    @error('page_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="content">Content:</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" wire:model="content"
                        placeholder="Enter Content"></textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button wire:click.prevent="storePost()" class="btn btn-success btn-block">Save</button>
                    <button wire:click.prevent="cancelPost()" class="btn btn-secondary btn-block">Cancel</button>
                </div>
            </form>
        @endif

    </div>
    <hr />
    <div class="card-body">
        <h3>Page List</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Page Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Content</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $pageData)
                        <tr>
                            <td>{{ $pageData->id }}</td>
                            <td>{{ $pageData->title }}</td>
                            <td>{{ $pageData->slug }}</td>
                            <td>{{ $pageData->content }}</td>
                            <td>
                                @if (empty($pageData->page_id))
                                    {{ 'Root' }}
                                @else
                                    {{ $pageData->parent->title }}
                                @endif
                            </td>
                            <td>
                                <button wire:click="edit({{ $pageData->id }})"
                                    class="btn btn-primary btn-sm">Edit</button>

                                <button type="button" wire:click="deleteId({{ $pageData->id }})"
                                    class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Delete
                                </button>

                                {{-- <button type="button" wire:click="deleteId({{ $pageData->id }})"
                                    class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                                    data-target="#exampleModal">Delete</button> --}}
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{ $pages->links('layouts.pagination') }}
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
