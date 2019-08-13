@extends('layouts.app', ['title' => __('Approved List Baptis')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman yang berisi permohonan baptis yang sudah diterima.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="fa fa-envelope-open"></i></h1>
                        <h3 class="text-center col-12">
                            {{ __('Approved List') }}
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-default alert-dismissable fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table id="table" class="ui celled table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="all" scope="col">Tanggal Baptis</th>
                                    <th class="all" scope="col">Waktu Baptis</th>
                                    <th class="all" scope="col">E-mail</th>
                                    <th class="all" scope="col">Nama Jemaat</th>
                                    <th class="all" scope="col">Nama Ayah</th>
                                    <th class="all" scope="col">Nama Ibu</th>
                                    <th class="all" scope="col">Tanggal Permohonan Dikirim</th>
                                    <th class="all" scope="col">Tanggal Update Permohonan</th>
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
        var groupColumn = 0;

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('leader.request.approved.dt') }}",
            columnDefs: [{
                    visible: false,
                    targets: groupColumn,
                },
                {
                    targets: 1,
                    render: $.fn.dataTable.render.moment('H:m:s', 'H:m'),
                },
                {
                    targets: [6, 7],
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
            ],
            "order": [[ groupColumn, 'asc' ]],
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
                            '<tr class="group"><td colspan="5">Tanggal Baptis: <br><b>' + moment(group).format('DD MMM YYYY') + '</b></td></tr>'
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
                    name: 'waktu'
                },
                {
                    name: 'email',
                    orderable: false,
                },
                {
                    name: 'jemaat.nama',
                    orderable: false,
                },
                {
                    name: 'jemaat.nama_ayah',
                    defaultContent: '-',
                    orderable: false,
                },
                {
                    name: 'jemaat.nama_ibu',
                    defaultContent: '-',
                    orderable: false,
                },
                {
                    name: 'created_at'
                },
                {
                    name: 'updated_at'
                },
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