<div class="modal fade" id="restore{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-success">
                    Delete {{ $category->name }}
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to Restore <span class="text-success">{{ $category->name }}</span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Restore</button>
                </div>
            </form>
        </div>
    </div>
</div>
