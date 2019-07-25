@extends('layouts.app', ['title' => __('Manajemen Pimpinan')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Ini adalah halaman Manajemen Pimpinan.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="fa fa-users"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Manajemen Pimpinan') }}
                        </h3>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="" class="px-5" autocomplete="off">
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
                            <label class="form-control-label" for="input-nama-lengkap">{{ __('Nama Lengkap') }}</label>
                            <input type="text" class="form-control" id="input-nama-lengkap" name="nama" placeholder="Nama Lengkap">
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">{{ __('E-mail') }}</label>
                            <input type="email" name="email" id="input-email"
                                class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('E-mail') }}" value="{{ old('email') }}"
                                required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-tgl-lhr">{{ __('Tanggal Lahir') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" id="input-tgl-lhr" name="tgl_lhr"
                                    placeholder="Tanggal Lahir" type="text" value="{{ old('tgl_lhr') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-role">{{ __('Kategori Pimpinan') }}</label>
                            <select class="custom-select" name="role" id="input-role">
                                <option value="0" selected disabled>-- Pilih Kategori --</option>
                                <option value="baptis_leader">Pimpinan Baptis</option>
                                <option value="KOM_leader">Pimpinan KOM</option>
                                <option value="KAJ_leader">Pimpinan KAJ</option>
                            </select>
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

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Nama Pimpinan</th>
                                    <th scope="col">Kategori Pimpinan</th>
                                    <th scope="col">Cabang Gereja</th>
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
    $(function () {
        $("#input-tgl-lhr").datepicker({
            format: 'yyyy-mm-dd',
        });
    });

    $(document).ready(function () {

    });
</script>
@endpush