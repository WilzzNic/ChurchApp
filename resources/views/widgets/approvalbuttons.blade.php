<div class="row">
    <div class="col">
        <form class="d-inline" method="post" action="{{ route('leader.request.approve', ['id' => $model->id]) }}">
            @csrf
            <button id="btn-approve" class="btn btn-icon btn-3 btn-success btn-sm" type="submit">
                <span class="btn-inner--text">Approve</span>
            </button>
        </form>

        <form class="d-inline" method="post" action="{{ route('leader.request.reject', ['id' => $model->id]) }}">
            @csrf
            <button id="btn-reject" class="btn btn-icon btn-3 btn-danger btn-sm" type="submit">
                <span class="btn-inner--text">Reject</span>
            </button>
        </form>
    </div>
</div>