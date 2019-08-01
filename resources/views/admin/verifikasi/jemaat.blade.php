@extends('layouts.app', ['title' => __('Verifikasi Baptis')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Verifikasi Jemaat.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="ni ni-paper-diploma"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Verifikasi Jemaat') }}
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
                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Jemaat</th>
                                    <th scope="col">No. FA</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Profesi</th>
                                    <th scope="col">Status Nikah</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Lokasi Ibadah</th>
                                    <th scope="col">Nama Ibu</th>
                                    <th scope="col">Nama Ayah</th>
                                    <th scope="col">Status Akun</th>
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

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        var dt = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            ajax: "{{ route('admin.manage.jemaat.dt') }}",
            columnDefs: [{
                targets: 2,
                render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
            }],
            columns: [
                {
                    name: 'id',
                    defaultContent: '-',
                },
                {
                    name: 'nama',
                    defaultContent: '-',
                },
                {
                    name: 'fa.FA_number',
                    defaultContent: '-',
                },
                {
                    name: 'jenis_kelamin',
                    defaultContent: '-',
                },
                {
                    name: 'tempat_lahir',
                    defaultContent: '-',
                },
                {
                    name: 'tgl_lahir',
                    defaultContent: '-',
                },
                {
                    name: 'profesi',
                    defaultContent: '-',
                },
                {
                    name: 'status_pernikahan',
                    defaultContent: '-',
                },
                {
                    name: 'no_hp',
                    defaultContent: '-',
                },
                {
                    name: 'alamat',
                    defaultContent: '-',
                },
                {
                    name: 'cabangGereja.nama_gereja',
                    defaultContent: '-',
                },
                {
                    name: 'nama_ibu',
                    defaultContent: '-',
                },
                {
                    name: 'nama_ayah',
                    defaultContent: '-',
                },
                {
                    name: 'status',
                    defaultContent: '-',
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