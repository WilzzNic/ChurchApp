@extends('layouts.app', ['title' => __('Manajemen Jadwal KOM')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Manajemen Jadwal KOM.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="fa fa-clock"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Manajemen Jadwal KOM') }}
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('leader.kom.jadwal.add') }}" class="px-5" autocomplete="off">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                        @endif

                        @if (session('errors'))
                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="form-control-label" for="input-seri">{{ __('Seri KOM') }}</label>
                            <select class="custom-select" name="seri_kom" id="input-seri">
                                <option value="0" disabled selected>-- Pilih Seri --</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-control-label" for="input-hari">{{ __('Hari') }}</label>
                                <select class="custom-select" name="hari" id="input-hari">
                                    <option value="0" disabled selected>-- Pilih Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label" for="input-waktu">{{ __('Waktu') }}</label>
                                <input type="time" class="form-control" name="waktu" id="input-waktu"
                                    placeholder="Waktu">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Tambah Jadwal') }}</button>
                        </div>

                        <hr class="my-3">

                        <div class="form-group">
                            <!-- Projects table -->
                            <table id="table" class="ui celled table" style="width:100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="all" scope="col">Seri KOM</th>
                                        <th class="all" scope="col">Hari</th>
                                        <th class="all" scope="col">Waktu</th>
                                        <th class="all" scope="col">Dibuat pada Tanggal</th>
                                        <th class="all" scope="col">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </form>
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
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('leader.kom.jadwal.dt') }}",
            columnDefs: [{
                    targets: 3,
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
                {
                    targets: 2,
                    render: $.fn.dataTable.render.moment('H:m:s', 'HH:mm'),
                },
            ],
            columns: [{
                    name: 'seri_kom'
                },
                {
                    name: 'hari'
                },
                {
                    name: 'waktu'
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