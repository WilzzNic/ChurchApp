@extends('layouts.app', ['title' => __('Request List')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman yang berisi permohonan untuk mengikuti KOM.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="fa fa-inbox"></i></h1>
                        <h3 class="text-center col-12 mb-3">{{ __('Request List') }}</h3>
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
                                <th class="all" scope="col">E-mail</th>
                                <th class="all" scope="col">Tanggal dikirim</th>
                                <th class="all" scope="col">Seri KOM</th>
                                <th class="all" scope="col">Jemaat</th>
                                <th class="all" scope="col">Asal Gereja</th>
                                <th class="all" scope="col">Waktu Kelas</th>
                                <th class="all" scope="col">Tanggal Kelas</th>
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
        padding:  !important .92857143em .78571429em;
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
            ajax: "{{ route('leader.request.show.dt') }}",
            columnDefs: [{
                    targets: 1,
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
                {
                    targets: 5,
                    render: $.fn.dataTable.render.moment('H:m:s', 'HH:mm'),
                },
            ],
            order: [
                [1, 'asc']
            ],
            columns: [{
                    name: 'email'
                },
                {
                    name: 'created_at'
                },
                {
                    name: 'jadwal.seri_kom',
                    orderable: false
                },
                {
                    name: 'jemaat.nama',
                    orderable: false
                },
                {
                    name: 'asal_gereja'
                },
                {
                    name: 'jadwal.waktu',
                    orderable: false
                },
                {
                    name: 'tanggal'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });

        t.on('order.dt search.dt', function () {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
</script>
@endpush