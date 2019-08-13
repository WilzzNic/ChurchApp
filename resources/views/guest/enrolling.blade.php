@extends('layouts.app', ['title' => __('Enrolling List')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman yang berisi guest yang sedang enroll KOM.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="ni ni-bus-front-12"></i></h1>
                        <h3 class="text-center col-12 mb-3">{{ __('Enrolling List') }}</h3>
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

                    <table id="table" class="ui celled table" style="width:100%;">
                        <thead>
                            <tr>
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
        var groupColumn = 0;

        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('leader.guest.kom.enrolling.dt') }}",
            columnDefs: [
                {
                    visible: false,
                    targets: groupColumn,
                },
                {
                    targets: 1,
                    render: $.fn.dataTable.render.moment('H:m:s', 'HH:mm'),
                },
            ],
            order: [[ groupColumn, 'asc' ]],
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(groupColumn, {
                    page: 'current'
                }).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td colspan="5">Tanggal Kelas: <br><b>' + moment(group).format('DD MMM YYYY') + '</b></td></tr>'
                        );

                        last = group;
                    }
                });
            },
            columns: [
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
                    name: 'complete',
                    orderable: false,
                    searchable: false
                }
            ],
        });

        // Order by the grouping
        $('#table tbody').on( 'click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                table.order( [ groupColumn, 'desc' ] ).draw();
            }
            else {
                table.order( [ groupColumn, 'asc' ] ).draw();
            }
        });
    });
</script>
@endpush