@extends('layouts.app', ['title' => __('Guest Pending List')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Halaman ini menampilkan data permohonan KOM dari simpatisan.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12"><i class="fa fa-inbox"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Request List') }}</h3>
                    </div>
                </div>
                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-default alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table id="table" class="ui celled table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="all" scope="col">Tanggal dikirim</th>
                                    <th class="all" scope="col">Tanggal Kelas</th>
                                    <th class="all" scope="col">Cabang Gereja</th>
                                    <th class="all" scope="col">Seri</th>
                                    <th class="all" scope="col">Waktu</th>
                                    <th class="all" scope="col">Hari</th>
                                    <th class="all" scope="col">Asal Gereja</th>
                                    <th class="all" scope="col">E-mail</th>
                                    <th class="all" scope="col">Jenis Kelamin</th>
                                    <th class="all" scope="col">Nama</th>
                                    <th class="all" scope="col">Tempat Lahir</th>
                                    <th class="all" scope="col">Tanggal Lahir</th>
                                    <th class="all" scope="col">No. HP</th>
                                    <th class="all" scope="col">Alamat</th>
                                    <th class="all" scope="col">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

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
        padding: !important .92857143em .78571429em;
        text-align: inherit;
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
        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('leader.guest.request.pending.dt') }}",
            columnDefs: [{
                    targets: 0,
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
                {
                    targets: 4,
                    render: $.fn.dataTable.render.moment('H:m:s', 'HH:mm'),
                },
            ],
            columns: [{
                    name: 'created_at'
                },
                {
                    name: 'tanggal'
                },
                {
                    name: 'cabang'
                },
                {
                    name: 'jadwal.seri_kom',
                    orderable: false
                },
                {
                    name: 'jadwal.waktu',
                    orderable: false
                },
                {
                    name: 'jadwal.hari',
                    orderable: false
                },
                {
                    name: 'guest.asal_gereja',
                    orderable: false
                },
                {
                    name: 'guest.email',
                    orderable: false
                },
                {
                    name: 'guest.jenis_kelamin',
                    orderable: false
                },
                {
                    name: 'guest.nama',
                    orderable: false
                },
                {
                    name: 'guest.tempat_lahir',
                    orderable: false
                },
                {
                    name: 'guest.tgl_lahir',
                    orderable: false
                },
                {
                    name: 'guest.no_hp',
                    orderable: false
                },
                {
                    name: 'guest.alamat',
                    orderable: false
                },
                {
                    name: 'approval',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    });
</script>
@endpush