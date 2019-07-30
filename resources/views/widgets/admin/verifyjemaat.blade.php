<div class="row">
    <div class="col">
        <form class="d-inline" method="post" action="{{ route('admin.manage.jemaat.validate', ['id' => $model->id]) }}">
            @csrf
            @method('PUT')
            <button id="btn-validate" class="btn btn-icon btn-3 btn-success btn-sm" type="submit">
                <span class="btn-inner--text">Validate</span>
            </button>
        </form>

        <form class="d-inline" method="post" action="{{ route('admin.manage.jemaat.invalidate', ['id' => $model->id]) }}">
            @csrf
            @method('PUT')
            <button id="btn-invalidate" class="btn btn-icon btn-3 btn-danger btn-sm" type="submit">
                <span class="btn-inner--text">Invalidate</span>
            </button>
        </form>
    </div>
</div>