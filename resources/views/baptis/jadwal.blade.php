@extends('layouts.app', ['title' => __('Manajemen Jadwal Baptis')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Manajemen Jadwal Baptis.'),
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
                            {{ __('Manajemen Jadwal Baptis') }}
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('leader.baptis.jadwal.add') }}" class="px-5" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-3">{{ __('Input Jadwal') }}</h6>
                        <hr class="mt-0 mb-3">

                        @if (session('status'))
                        <div class="alert alert-default alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group {{ $errors->has('tanggal') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-tgl">{{ __('Tanggal Baptis yang Dikecualikan') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" id="input-tgl" name="tanggal" placeholder="Tanggal" type="text" value="{{ old('tanggal') }}">
                            </div>
                            @if ($errors->has('tanggal'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('tanggal') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Tambah Jadwal') }}</button>
                        </div>

                        <h6 class="heading-small text-muted my-3">{{ __('Data Cabang') }}</h6>
                        <hr class="mt-0 mb-3">

                        <div class="form-group">
                            <!-- Projects table -->
                            <table id="table" class="ui celled table" style="width:100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="all" scope="col">ID</th>
                                        <th class="all" scope="col">Tanggal</th>
                                        <th class="all" scope="col">Dibuat pada Tanggal</th>
                                        <th class="all" scope="col">Tindak Lanjut</th>
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
        padding: .92857143em .78571429em;
        text-align: inherit;
    }
    .ui.grid {
        margin-top: -1rem;
        margin-bottom: -1rem;
        margin-left: 1rem;
        margin-right: -1rem;
    }
    .has-success::after, .has-danger::after {
        top: 29px;
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
            ajax: "{{ route('leader.baptis.jadwal.dt') }}",
            columnDefs: [{
                    targets: 2,
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
            ],
            columns: [{
                    name: 'id'
                },
                {
                    name: 'tanggal'
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

    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: [1,2,3,4,5,6],
            startDate: '+0d',
        });
    });
</script>
@endpush