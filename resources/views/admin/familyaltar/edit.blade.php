@extends('layouts.app', ['title' => __('Manajemen Family Altar')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Ini adalah halaman Manajemen Family Altar.'),
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
                            {{ __('Verifikasi Manajemen Family Altar') }}
                        </h3>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.manage.fa.update', ['id' => $family_altar->id]) }}" class="px-5" autocomplete="off">
                        @csrf
                        @method('PUT')

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
                            <input type="hidden" name="jemaat_id" value="{{ $family_altar->owner_id}}">
                            <input type="text" id="jemaat" class="form-control" name="jemaat" value="{{ $family_altar->owner->nama }}" disabled>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-daerah">{{ __('Daerah') }}</label>
                            <select class="custom-select" name="daerah" id="input-daerah" required>
                                <option value="0" selected disabled>-- Pilih Daerah --</option>
                                @foreach($daerahs as $daerah)
                                <option value="{{ $daerah->id }}" {{ $family_altar->daerah_id == $daerah->id ? 'selected' : '' }}>{{ $daerah->nama_daerah }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label class="form-control-label" for="input-hari">{{ __('Hari') }}</label>
                                <select class="custom-select" name="hari" id="input-hari" required>
                                    <option value="0" selected disabled>-- Pilih Hari --</option>
                                    <option value="Minggu" {{ $family_altar->hari == "Minggu" ? 'selected' : '' }}>Minggu</option>
                                    <option value="Senin" {{ $family_altar->hari == "Senin" ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $family_altar->hari == "Selasa" ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ $family_altar->hari == "Rabu" ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $family_altar->hari == "Kamis" ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $family_altar->hari == "Jumat" ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ $family_altar->hari == "Sabtu" ? 'selected' : '' }}>Sabtu</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-control-label" for="input-waktu">{{ __('Waktu') }}</label>
                                <input type="time" class="form-control" id="input-waktu" name="waktu" value="{{ date('h:i', strtotime($family_altar->waktu)) }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-no-fa">{{ __('No. Family Altar') }}</label>
                            <input type="text" class="form-control" id="input-no-fa" name="no_fa" value="{{ $family_altar->FA_number }}"
                                placeholder="No. Family Altar" required>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                            <input type="text" name="alamat" id="input-alamat"
                                class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Alamat') }}" value="{{ $family_altar->alamat }}" required>

                            @if ($errors->has('alamat'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ __('Simpan') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection