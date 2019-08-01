@extends('layouts.app', ['title' => __('Manajemen Family Altar')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Manajemen Family Altar.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="fa fa-users"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Manajemen Family Altar') }}
                        </h3>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.manage.fa.add') }}" class="px-5" autocomplete="off">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-default alert-dismissable fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="form-control-label" for="input-jemaat">{{ __('Jemaat') }}</label>
                            <select class="form-control js-example-responsive" name="jemaat" id="input-jemaat">
                                <option value="0" selected disabled>-- Pilih Jemaat --</option>
                                @foreach($jemaats as $jemaat)
                                <option value="{{ $jemaat->id }}">
                                    {{ $jemaat->nama }} ({{ $jemaat->user->email }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-daerah">{{ __('Daerah') }}</label>
                            <select class="form-control js-example-responsive" name="daerah" id="input-daerah">
                                <option value="0" selected disabled>-- Pilih Daerah --</option>
                                @foreach($daerahs as $daerah)
                                <option value="{{ $daerah->id }}">{{ $daerah->nama_daerah }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label class="form-control-label" for="input-hari">{{ __('Hari') }}</label>
                                <select class="custom-select" name="hari" id="input-hari">
                                    <option value="0" selected disabled>-- Pilih Hari --</option>
                                    <option value="Minggu">Minggu</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-control-label" for="input-waktu">{{ __('Waktu') }}</label>
                                <input type="time" class="form-control" id="input-waktu" name="waktu">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-no-fa">{{ __('No. Family Altar') }}</label>
                            <input type="text" class="form-control" id="input-no-fa" name="no_fa"
                                placeholder="No. Family Altar">
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                            <input type="text" name="alamat" id="input-alamat"
                                class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Alamat') }}" value="" required>

                            @if ($errors->has('alamat'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Tambah') }}</button>
                        </div>

                    </form>

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Pemilik</th>
                                    <th scope="col">No. FA</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Waktu</th>
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
    .select2 {
        width: 100% !important;
    }
</style>
@endpush

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#input-jemaat').select2({
            placeholder: 'Pilih Jemaat',
            width: 'resolve',
        });

        $('#input-daerah').select2({
            placeholder: 'Pilih Daerah',
            width: 'resolve',
        });

        var dt = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            ajax: "{{ route('admin.manage.fa.dt') }}",
            columnDefs: [{
                targets: 5,
                render: $.fn.dataTable.render.moment('H:m:s', 'HH:mm'),
            }],
            columns: [{
                    name: 'id'
                },
                {
                    name: 'owner.nama'
                },
                {
                    name: 'FA_number'
                },
                {
                    name: 'alamat'
                },
                {
                    name: 'hari'
                },
                {
                    name: 'waktu'
                },
                {
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    });

</script>
@endpush