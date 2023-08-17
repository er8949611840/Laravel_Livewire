<div class="card">
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
                <select class="form-control @error('page_id') is-invalid @enderror" id="page_id" wire:model="page_id">
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
                <button wire:click.prevent="storePost()" class="btn btn-success btn-block">Save</button>
                <button wire:click.prevent="cancelPost()" class="btn btn-secondary btn-block">Cancel</button>
            </div>
        </form>
    </div>
</div>
