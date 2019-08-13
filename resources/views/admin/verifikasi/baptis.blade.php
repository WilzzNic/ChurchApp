@extends('layouts.app', ['title' => __('Verifikasi Baptis')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Verifikasi Baptis.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="ni ni-paper-diploma"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Verifikasi Sertifikat Baptis') }}
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
                    <!-- Projects table -->
                    <table id="table" class="ui celled table" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="all" scope="col">ID</th>
                                <th class="all" scope="col">Jemaat</th>
                                <th class="all" scope="col">Diupload pada Tanggal</th>
                                <th class="all" scope="col">Sertifikat Baptis</th>
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
        margin-top: -1rem;
        margin-bottom: -1rem;
        margin-left: 1rem;
        margin-right: -1rem;
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
            responsive: {
                details: false
            },
            ajax: "{{ route('admin.manage.baptis.dt') }}",
            columnDefs: [{
                targets: 2,
                render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
            }],
            columns: [{
                    name: 'id'
                },
                {
                    name: 'jemaat.nama'
                },
                {
                    name: 'created_at'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    });
</script>
@endpush