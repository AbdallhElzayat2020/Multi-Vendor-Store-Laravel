<div class="modal fade" id="delete{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-danger">
                    Delete {{ $category->name }}
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    {{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
                    <p>Are you sure you want to delete <span class="text-danger">{{ $category->name }}</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
