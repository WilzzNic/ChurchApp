@extends('layouts.app', ['title' => __('Request KOM by Guest')])

@section('content')
@include('users.partials.header', [
'title' => __('Selamat datang di Website Rumah Persembahan!'),
'description' => __('Lengkapi data diri anda untuk mendaftar Kelas Orientasi Melayani.'),
'class' => 'col-sm-6 offset-lg-4 offset-md-0 offset-sm-2 text-center'
])

<div class="container-fluid mt--7">
    <div class="row justify-content-sm-center">
        <div class="col-sm-8">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('General Description') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('guest.kom.request.send') }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pl-lg-4">
                            <div class="form-group">
                                <div class="text-center">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="jenis_kelamin" class="custom-control-input" id="customRadio1"
                                            type="radio" value="L" checked>
                                        <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="jenis_kelamin" class="custom-control-input" id="customRadio2"
                                            type="radio" value="P">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nama">
                                    {{ __('Nama') }}
                                </label>
                                <input type="text" name="nama" id="input-nama"
                                    class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Nama') }}" value="{{ old('nama') }}" required>

                                @if ($errors->has('nama'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('no_hp') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-hp">
                                    {{ __('No. HP') }}
                                </label>
                                <input type="text" name="no_hp" id="input-hp"
                                    class="form-control form-control-alternative{{ $errors->has('no_hp') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('No. HP') }}" value="{{ old('no_hp') }}">

                                @if ($errors->has('no_hp'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('no_hp') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-alamat">
                                    {{ __('Alamat') }}
                                </label>
                                <textarea class="form-control form-control-alternative" id="input-alamat" rows="3"
                                    name="alamat"
                                    placeholder="Tulis alamat lengkap di sini..">{{ old('alamat') }}</textarea>

                                @if ($errors->has('alamat'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="form-control-label" for="input-tmpt-lhr">
                                        {{ __('Tempat Lahir') }}
                                    </label>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-planet"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('tmpt_lhr') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Tempat Lahir') }}" type="text" id="input-tmpt-lhr"
                                            name="tmpt_lhr" value="{{ old('tmpt_lhr') }}" required>
                                    </div>
                                    @if ($errors->has('tmpt_lhr'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('tmpt_lhr') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label class="form-control-label" for="input-tgl-lhr">
                                        {{ __('Tanggal Lahir') }}
                                    </label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input
                                            class="form-control {{ $errors->has('tgl_lhr') ? ' is-invalid' : '' }} datepicker"
                                            id="input-tgl-lhr" name="tgl_lhr" placeholder="Tanggal Lahir" type="text"
                                            value="{{ old('tgl_lhr') }}">
                                    </div>
                                    @if ($errors->has('tgl_lhr'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('tgl_lhr') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"
                                    for="input-asal-gereja">{{ __('Asal Gereja') }}</label>
                                <input id="input-asal-gereja" class="form-control form-control-alternative"
                                    name="asal_gereja"
                                    value="{{ old('asal_gereja') }}"
                                    placeholder="Asal Gereja" type="text" required>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('E-mail') }}</label>
                                <input type="email" name="email" id="input-email"
                                    class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('E-mail') }}" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <hr class="my-4" />

                            <div class="form-group">
                                <label class="form-control-label" for="input-cabang">{{ __('Cabang') }}</label>
                                <select class="js-example-responsive form-control" name="cabang" id="input-cabang">
                                    <option value="0" selected disabled>-- Pilih Cabang --</option>
                                    @foreach($cab_gerejas as $cab_gereja)
                                    <option value="{{ $cab_gereja->id }}"
                                        {{ old('cabang') == $cab_gereja->id ? 'selected' : '' }}>
                                        {{ $cab_gereja->nama_gereja }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="input-seri">{{ __('Seri KOM') }}</label>
                                <select class="custom-select" name="seri" id="input-seri">
                                    <option value="0" disabled selected>-- Pilih Seri --</option>
                                    <option value="100" {{ old('seri') == '100' ? 'selected' : '' }}>100</option>
                                    <option value="200" {{ old('seri') == '200' ? 'selected' : '' }}>200</option>
                                    <option value="300" {{ old('seri') == '300' ? 'selected' : '' }}>300</option>
                                    <option value="400" {{ old('seri') == '400' ? 'selected' : '' }}>400</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-control-label" for="input-jadwal">{{ __('Tanggal KOM') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input id="input-jadwal" class="form-control datepicker" name="tanggal"
                                            placeholder="Tanggal" type="text" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label" for="input-waktu">{{ __('Waktu KOM') }}</label>
                                    <select class="custom-select" name="waktu" id="input-waktu" disabled>
                                        <option value="0" disabled selected>-- Pilih Waktu KOM --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Daftar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    $(document).ready(function() {
        $('.js-example-responsive').select2({
            placeholder: 'Pilih Cabang Gereja',
            width: 'resolve',
        });
    });

    $('#input-cabang').on('change', function(e) {
        $('#input-jadwal').val("").datepicker("update");
        $.ajax({
            type: "POST",
            url: "{{ route('guest.kom.request.schedule') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cabang": $('#input-cabang').val(),
                "seri"  : $('#input-seri').val(),
            }
        }).done(function(messages) {
            $('#input-waktu').children('option:not(:first)').remove();

            if(messages == null || messages.length < 1) {
                $('#input-jadwal').prop('disabled', true);
                $('#input-waktu').prop('disabled', true);
            }
            else {
                $('#input-jadwal').prop('disabled', false);
                $('#input-waktu').prop('disabled', false);

                haris = [];

                messages.forEach(function(jadwal) {
                    if(jadwal.hari == "Minggu") {
                        haris.push(0);
                        jadwals.push({ id:jadwal.id, hari:0, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Senin") {
                        haris.push(1);
                        jadwals.push({ id:jadwal.id, hari:1, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Selasa") {
                        haris.push(2);
                        jadwals.push({ id:jadwal.id, hari:2, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Rabu") {
                        haris.push(3);
                        jadwals.push({ id:jadwal.id, hari:3, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Kamis") {
                        haris.push(4);
                        jadwals.push({ id:jadwal.id, hari:4, waktu:jadwal.waktu });
                    } 
                    else if(jadwal.hari == "Jumat") {
                        haris.push(5);
                        jadwals.push({ id:jadwal.id, hari:5, waktu:jadwal.waktu });
                    } 
                    else if(jadwal.hari == "Sabtu") {
                        haris.push(6);
                        jadwals.push({ id:jadwal.id, hari:6, waktu:jadwal.waktu });
                    }
                });

                calendar_set = full_set.diff(haris);

                $('#input-jadwal').datepicker("setDaysOfWeekDisabled", calendar_set);
            }
        });
    });

    Array.prototype.diff = function(a) {
        return this.filter(function(i) {return a.indexOf(i) < 0;});
    };


    $('#input-seri').change(function() {
        $('#input-jadwal').val("").datepicker("update");
        $.ajax({
            type: "POST",
            url: "{{ route('guest.kom.request.schedule') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cabang": $('#input-cabang').val(),
                "seri"  : $('#input-seri').val(),
            }
        }).done(function(messages) {
            console.log("halo dari messages")
            console.log(messages)
            $('#input-waktu').children('option:not(:first)').remove();

            if(messages == null || messages.length < 1) {
                $('#input-jadwal').prop('disabled', true);
                $('#input-waktu').prop('disabled', true);
            }
            else {
                $('#input-jadwal').prop('disabled', false);
                $('#input-waktu').prop('disabled', false);

                haris = [];
                jadwals = [];

                result = [];

                messages.forEach(function(jadwal) {
                    if(jadwal.hari == "Minggu") {
                        haris.push(0);
                        jadwals.push({ id:jadwal.id, hari:0, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Senin") {
                        haris.push(1);
                        jadwals.push({ id:jadwal.id, hari:1, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Selasa") {
                        haris.push(2);
                        jadwals.push({ id:jadwal.id, hari:2, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Rabu") {
                        haris.push(3);
                        jadwals.push({ id:jadwal.id, hari:3, waktu:jadwal.waktu });
                    }
                    else if(jadwal.hari == "Kamis") {
                        haris.push(4);
                        jadwals.push({ id:jadwal.id, hari:4, waktu:jadwal.waktu });
                    } 
                    else if(jadwal.hari == "Jumat") {
                        haris.push(5);
                        jadwals.push({ id:jadwal.id, hari:5, waktu:jadwal.waktu });
                    } 
                    else if(jadwal.hari == "Sabtu") {
                        haris.push(6);
                        jadwals.push({ id:jadwal.id, hari:6, waktu:jadwal.waktu });
                    }
                });

                calendar_set = full_set.diff(haris);

                $('#input-jadwal').datepicker("setDaysOfWeekDisabled", calendar_set);
            }
        });
    });

    var haris = [];
    var jadwals = [];
    var result = [];
    var day = -1;

    var full_set = [0,1,2,3,4,5,6];
    var calendar_set = [1,2,3,4,5,6];

    $(function() {
        $('#input-tgl-lhr').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '+0d',
        });

        $('#input-jadwal').datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: calendar_set,
            startDate: '+0d',
        });

        $('#input-jadwal').datepicker().on('changeDate', function(e) {
            day = e.format('DD');

            if(day == 'Sunday') {
                day = 0;
            }
            else if(day == 'Monday') {
                day = 1;
            }
            else if(day == 'Tuesday') {
                day = 2;
            }
            else if(day == 'Wednesday') {
                day = 3;
            }
            else if(day == 'Thursday') {
                day = 4;
            }
            else if(day == 'Friday') {
                day = 5;
            }
            else if(day == 'Saturday') {
                day = 6;
            }

            result = jadwals.filter(jadwal => {
                return jadwal.hari == day;
            });

            $('#input-waktu').children('option:not(:first)').remove();

            result.forEach(function(jadwal) {
                $("#input-waktu").append(new Option(moment(jadwal.waktu, "HH:mm:ss").format("HH:mm"), jadwal.id));
            });
        })
    });
</script>
@endpush