<div class="row">
    <div class="col-md-4">
        <button id="btn-approve" data-toggle="modal" data-target="#modalApprove" data-request="{{ $model->id }}" class="btn btn-icon btn-3 btn-success btn-sm" type="button">
            <span class="btn-inner--text">Approve</span>
        </button>
    </div>

    <div class="col-md-4">
        <form method="post" action="{{ route('leader.request.reject', ['id' => $model->id]) }}">
            @csrf
            <button id="btn-reject" class="btn btn-icon btn-3 btn-danger btn-sm" type="submit">
                <span class="btn-inner--text">Reject</span>
            </button>
        </form>
    </div>
</div>