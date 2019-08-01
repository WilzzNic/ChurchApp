<form method="POST" action="{{ route('leader.kom.enrolling.complete', ['id' => $model->id]) }}">
    @csrf
    @method('PUT')

    <button id="btn-delete" class="btn btn-icon btn-3 btn-success btn-sm" type="submit">
        <span class="btn-inner--icon"><i class="ni ni-paper-diploma"></i></span>
        <span class="btn-inner--text">Complete</span>
    </button>
</form>