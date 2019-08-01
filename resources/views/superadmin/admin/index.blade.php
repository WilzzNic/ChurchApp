@extends('layouts.app', ['title' => __('Manajemen Admin')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Manajemen Admin.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="ni ni-circle-08"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Manajemen Admin') }}
                        </h3>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('superadmin.manage.admin.add') }}" class="px-5"
                        autocomplete="off">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if ($errors->has('msg'))
                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $errors->first('msg') }}
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="text-center">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="jenis_kelamin" class="custom-control-input" id="customRadio1"
                                        type="radio" value="L" checked
                                        {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="jenis_kelamin" class="custom-control-input" id="customRadio2"
                                        type="radio" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-cabang">{{ __('Cabang') }}</label>
                            <select class="form-control js-example-basic-single" name="cabang" id="input-cabang">
                                <option value="0">-- Pilih Cabang --</option>
                                @foreach($cabangs as $cabang)
                                <option value="{{ $cabang->id }}" {{ old('cabang') == $cabang->id ? 'selected' : '' }}>
                                    {{ $cabang->nama_gereja }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-nama-lengkap">{{ __('Nama Lengkap') }}</label>
                            <input type="text"
                                class="form-control form-control-alternative {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                id="input-nama-lengkap" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}"
                                required>
                            @if ($errors->has('nama'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">{{ __('E-mail') }}</label>
                            <input type="email" name="email" id="input-email"
                                class="form-control form-control-alternative {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('tgl_lhr') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="input-tgl-lhr">{{ __('Tanggal Lahir') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input
                                    class="form-control form-control-alternative {{ $errors->has('tgl_lhr') ? ' is-invalid' : '' }} datepicker"
                                    id="input-tgl-lhr" name="tgl_lhr" placeholder="Tanggal Lahir" type="text"
                                    value="{{ old('tgl_lhr') }}">
                            </div>
                            @if ($errors->has('tgl_lhr'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tgl_lhr') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                            <input type="password" name="password" id="input-password"
                                class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Password') }}" value="" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-control-label"
                                for="input-password-confirmation">{{ __('Konfirmasi Password') }}</label>
                            <input type="password" name="password_confirmation" id="input-password-confirmation"
                                class="form-control form-control-alternative"
                                placeholder="{{ __('Konfirmasi Password') }}" value="" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Tambah') }}</button>
                        </div>
                    </form>

                    <hr class="my-3">

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Nama Admin</th>
                                    <th scope="col">Cabang</th>
                                    <th scope="col">Didaftarkan pada Tanggal</th>
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
    $(function () {
        $("#input-tgl-lhr").datepicker({
            format: 'yyyy-mm-dd',
            endDate: '0d',
        });
    });

    $(document).ready(function () {
        $('#input-cabang').select2({
            placeholder: 'Pilih Cabang Gereja'
        });

        $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            ajax: "{{ route('superadmin.manage.admin.dt') }}",
            columnDefs: [{
                targets: 3,
                render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s',
                    'YYYY-MM-DD'),
            }, ],
            columns: [{
                    name: 'email'
                },
                {
                    name: 'jemaat.nama'
                },
                {
                    name: 'cabang',
                    orderable: false
                },
                {
                    name: 'created_at'
                },
                {
                    name: 'admin',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    });
</script>
@endpush