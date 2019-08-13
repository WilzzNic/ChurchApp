@extends('layouts.app', ['title' => __('Request List KAJ')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman untuk menerima permohonan KAJ.'),
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

                    <table id="table" class="ui celled table" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="all" scope="col">#</th>
                                <th class="all" scope="col">Tanggal dikirim</th>
                                <th class="all" scope="col">Jemaat</th>
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
        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('leader.request.show.dt') }}",
            columnDefs: [ 
                {
                    searchable: false,
                    orderable: false,
                    targets: 0
                },
                {
                    targets: 1,
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
            ],
            order: [[ 1, 'asc' ]],
            columns: [
                { name: 'id' },
                { name: 'created_at'},
                { name: 'jemaat.nama' },
                { name: 'action', orderable: false, searchable: false }
            ],
        });

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>
@endpush