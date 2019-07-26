@extends('layouts.app', ['title' => __('Manajemen Data Daerah')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Ini adalah halaman Manajemen Data Daerah.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="ni ni-map-big"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Manajemen Daerah') }}
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('superadmin.manage.daerah.add') }}" class="px-5" autocomplete="off">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-default alert-dismissable fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('nama_daerah') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-daerah">{{ __('Nama Daerah') }}</label>
                            <input type="text" name="nama_daerah" id="input-daerah" class="form-control form-control-alternative{{ $errors->has('nama_daerah') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Nama Daerah') }}" value="" required>

                            @if ($errors->has('nama_daerah'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('nama_daerah') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Tambah') }}</button>
                        </div>

                        <hr class="my-3">
                        
                        <div class="form-group">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Daerah</th>
                                            <th scope="col">Dibuat pada Tanggal</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </form>
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
            ajax: "{{ route('superadmin.manage.daerah.dt') }}",
            columnDefs: [{
                targets: 2,
                render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
            }],
            columns: [
                {
                    name: 'id'
                },
                {
                    name: 'nama_daerah'
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