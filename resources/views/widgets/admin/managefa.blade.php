<div class="row">
    <form method="GET" action="{{ route('admin.manage.fa.edit', ['id' => $model->id]) }}">
        <button id="edit" class="btn btn-icon btn-3 btn-success btn-sm" type="submit">
            <span class="btn-inner--text">Edit</span>
        </button>
    </form>
</div>
<div class="row">
    <form method="post" action="{{ route('admin.manage.fa.delete', ['id' => $model->id]) }}">
        @csrf
        @method('DELETE')
        <button id="btn-delete" class="btn btn-icon btn-3 btn-danger btn-sm" type="submit">
            <span class="btn-inner--text">Delete</span>
        </button>
    </form>
</div>