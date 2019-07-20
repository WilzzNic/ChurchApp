<form method="post" action="{{ route('bcon.requestfa.send', ['id' => $family_altar->id]) }}">
    @csrf
    <button class="btn btn-icon btn-3 btn-default btn-sm" type="submit">
        <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
        <span class="btn-inner--text">Request</span>
    </button>
</form>