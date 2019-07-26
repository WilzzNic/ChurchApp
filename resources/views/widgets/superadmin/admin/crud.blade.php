<form method="post" action="{{ route('superadmin.manage.admin.delete', ['id' => $model->id]) }}">
    @csrf
    @method('DELETE')
    <button id="btn-delete" class="btn btn-icon btn-3 btn-danger btn-sm" type="submit">
        <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
        <span class="btn-inner--text">Delete</span>
    </button>
</form>