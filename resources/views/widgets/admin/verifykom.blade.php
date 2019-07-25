<div class="row">
    <div class="col-md-3">
        <form action="{{ route('admin.manage.kom.img', ['id' => $model->id]) }}" method="GET">
            <button id="btn-view" class="btn btn-icon btn-3 btn-default btn-sm" type="submit">
                <span class="btn-inner--text">View</span>
            </button>
        </form>
    </div>

    <div class="col-md-3">
        <form method="post" action="{{ route('admin.manage.kom.validate', ['id' => $model->id]) }}">
            @csrf
            @method('PUT')
            <button id="btn-validate" class="btn btn-icon btn-3 btn-success btn-sm" type="submit">
                <span class="btn-inner--text">Validate</span>
            </button>
        </form>
    </div>

    <div class="col-md-3">
        <form method="post" action="{{ route('admin.manage.kom.invalidate', ['id' => $model->id]) }}">
            @csrf
            @method('PUT')
            <button id="btn-invalidate" class="btn btn-icon btn-3 btn-danger btn-sm" type="submit">
                <span class="btn-inner--text">Invalidate</span>
            </button>
        </form>
    </div>
</div>