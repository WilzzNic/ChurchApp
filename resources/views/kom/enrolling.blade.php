@extends('layouts.app', ['title' => __('Enrolling List')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman yang berisi jemaat yang sedang enroll KOM.'),
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

                    <div class="table-responsive">
                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Tanggal Kelas</th>
                                    <th scope="col">Waktu Kelas</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Seri KOM</th>
                                    <th scope="col">Jemaat</th>
                                    <th scope="col">Asal Gereja</th>
                                    <th scope="col">Actions</th>
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
    thead th { white-space: nowrap; }
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
            ajax: "{{ route('leader.kom.enrolling.dt') }}",
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
                { name: 'tanggal' },
                { name: 'jadwal.waktu', orderable: false },
                { name: 'email' },
                { name: 'jadwal.seri_kom', orderable: false },
                { name: 'jemaat.nama', orderable: false },
                { name: 'asal_gereja' },
                { name: 'complete', orderable: false, searchable: false }
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