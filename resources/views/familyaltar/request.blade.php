@extends('layouts.app', ['title' => __('Family Altar')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman untuk mengajukan permohonan bergabung dengan Family Altar.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12"><i class="fa fa-users"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Family Altar') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">
                            Ayo bergabung dan tumbuh bersama Family Altar. Temukan Family Altar terdekat dengan
                            lingkungan saudara.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @if(!auth()->user()->jemaat->requestAltar)

                    @if (session('status'))
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-control-label" for="input-daerah">{{ __('Daerah') }}</label>
                            <select class="custom-select" name="daerah" id="input-daerah">
                                <option value="0" selected>Semua Daerah</option>
                                @foreach($daerahs as $daerah)
                                <option value="{{ $daerah->id }}">{{ $daerah->nama_daerah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <!-- Projects table -->
                            <table id="table" class="ui celled table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="all" scope="col">No. FA</th>
                                        <th class="all" scope="col">Owner</th>
                                        <th class="all" scope="col">No. HP</th>
                                        <th class="all" scope="col">Daerah</th>
                                        <th class="all" scope="col">Alamat</th>
                                        <th class="all" scope="col">Hari</th>
                                        <th class="all" scope="col">Waktu</th>
                                        <th class="all" scope="col">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    @else
                    <form class="px-5" method="POST"
                        action="{{ route('bcon.requestfa.leave', ['id' => auth()->user()->jemaat->requestAltar->id]) }}">
                        @csrf
                        @method('DELETE')

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <div class="form-group row">
                            <label for="staticAltarNum" class="col-sm-2 col-form-label"><b>No. Family Altar</b></label>
                            <div class="col-sm-10">
                                <b>
                                    <input type="text" readonly class="form-control-plaintext" id="staticAltarNum"
                                        value="{{ auth()->user()->jemaat->requestAltar->fa->FA_number }}">
                                </b>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticOwner" class="col-sm-2 col-form-label"><b>Owner</b></label>
                            <div class="col-sm-10">
                                <b>
                                    <input type="text" readonly class="form-control-plaintext" id="staticOwner"
                                        value="{{ auth()->user()->jemaat->requestAltar->fa->owner->nama }}">
                                </b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticAlamat" class="col-sm-2 col-form-label"><b>Alamat</b></label>
                            <div class="col-sm-10">
                                </b>
                                <input type="text" readonly class="form-control-plaintext" id="staticAlamat"
                                    value="{{ auth()->user()->jemaat->requestAltar->fa->alamat }}, {{ auth()->user()->jemaat->requestAltar->fa->daerah->nama_daerah }}">
                                </b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticJadwal" class="col-sm-2 col-form-label"><b>Jadwal</b></label>
                            <div class="col-sm-10">
                                </b>
                                <input type="text" readonly class="form-control-plaintext" id="staticJadwal"
                                    value="{{ auth()->user()->jemaat->requestAltar->fa->hari }}, pukul {{ date('H:i', strtotime(auth()->user()->jemaat->requestAltar->fa->waktu)) }}">
                                </b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticStatus" class="col-sm-2 col-form-label"><b>Status</b></label>
                            <div class="col-sm-10">
                                </b>
                                <input type="text" readonly class="form-control-plaintext" id="staticStatus"
                                    value="{{ auth()->user()->jemaat->requestAltar->status }}">
                                </b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticCreatedAt" class="col-sm-2 col-form-label"><b>Dikirim pada
                                    tanggal</b></label>
                            <div class="col-sm-10">
                                </b>
                                <input type="text" readonly class="form-control-plaintext" id="staticCreatedAt"
                                    value="{{ date('Y-m-d', strtotime(auth()->user()->jemaat->requestAltar->created_at)) }}">
                                </b>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-danger mt-4">{{ __('Keluar dari Altar') }}</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('css')
<style>
    thead th {
        white-space: nowrap;
    }

    .ui.table td {
        padding:  !important .92857143em .78571429em;
        text-align: !important inherit;
    }

    .ui.grid {
        margin-top: 0rem;
        margin-bottom: 0rem;
        margin-left: 1rem;
        margin-right: 0rem;
    }
</style>
@endpush

@push('js')
<script type="text/javascript">
    $(document).ready(function () {

        var dt = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            ajax: {
                url: "{{ route('bcon.altardt.daerah') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d) {
                    d.daerah = $('#input-daerah').val()
                }
            },
            responsive: {
                details: false
            },
            columnDefs: [{
                targets: 6,
                render: $.fn.dataTable.render.moment('H:m:s', 'HH:mm'),
            }],
            columns: [{
                    name: 'FA_number'
                },
                {
                    name: 'owner.nama',
                    orderable: false
                },
                {
                    name: 'owner.no_hp',
                    orderable: false
                },
                {
                    name: 'daerah.nama_daerah',
                    orderable: false
                },
                {
                    name: 'alamat',
                    orderable: false
                },
                {
                    name: 'hari',
                    orderable: false
                },
                {
                    name: 'waktu',
                    orderable: false
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });

        $('#input-daerah').change(function () {
            dt.ajax.reload();
        });
    });

    $(function () {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: [1, 2, 3, 4, 5, 6],
            startDate: '+0d',
        });
    });
</script>
@endpush