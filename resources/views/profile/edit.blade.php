@extends('layouts.app', ['title' => __('General Description')])

@section('content')
@if(Auth::user()->can('guest'))
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Lengkapi data diri anda untuk mengakses layanan.'),
'class' => 'col-lg-12'
])
@else
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Halaman ini memuat profil Anda.'),
'class' => 'col-lg-12'
])
@endif

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('General Description') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" enctype='multipart/form-data'
                        autocomplete="off">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                        <h6 class="text-muted mb-4">(<span style="color:red;">*</span>) menandakan data yang perlu diisi
                            untuk mengakses pelayanan minimum yang tersedia.</h6>

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
                                            type="radio" value="L" {{ $data['jenis_kelamin'] == 'L' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="jenis_kelamin" class="custom-control-input" id="customRadio2"
                                            type="radio" value="P" {{ $data['jenis_kelamin'] == 'P' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="staticNIJ" class="form-control-label">NIJ</label>
                                <input type="text" readonly class="form-control-plaintext" id="staticNIJ"
                                    value="{{ (!is_null($data['seri_keluarga']) && !is_null($data['seri_jemaat'])) ?
                                    str_pad($data['seri_keluarga'], 5, '0', STR_PAD_LEFT) . ' - ' . str_pad($data['seri_jemaat'], 5, '0', STR_PAD_LEFT) :
                                    '-' }}">

                            </div>

                            <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nama">{{ __('Nama') }}<span
                                        style="color:red;">*</span></label>
                                <input type="text" name="nama" id="input-nama"
                                    class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Nama') }}" value="{{ old('nama', $data['nama']) }}" required>

                                @if ($errors->has('nama'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('no_hp') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-hp">{{ __('No. HP') }}<span
                                        style="color:red;">*</span></label>
                                <input type="text" name="no_hp" id="input-hp"
                                    class="form-control form-control-alternative{{ $errors->has('no_hp') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('No. HP') }}" value="{{ old('no_hp', $data['no_hp']) }}">

                                @if ($errors->has('no_hp'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('no_hp') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}<span
                                        style="color:red;">*</span></label>
                                <textarea class="form-control form-control-alternative" id="input-alamat" rows="3"
                                    name="alamat"
                                    placeholder="Tulis alamat lengkap di sini..">{{ old('alamat', $data['alamat']) }}</textarea>

                                @if ($errors->has('alamat'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="form-control-label" for="input-tmpt-lhr">{{ __('Tempat Lahir') }}<span
                                            style="color:red;">*</span></label>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-planet"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('tmpt_lhr') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Tempat Lahir') }}" type="text" id="input-tmpt-lhr"
                                            name="tmpt_lhr" value="{{ old('tmpt_lhr', $data['tempat_lahir']) }}"
                                            required>
                                    </div>
                                    @if ($errors->has('tmpt_lhr'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('tmpt_lhr') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label class="form-control-label" for="input-tgl-lhr">{{ __('Tanggal Lahir') }}<span
                                            style="color:red;">*</span></label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" id="input-tgl-lhr" name="tgl_lhr"
                                            placeholder="Tanggal Lahir" type="text"
                                            value="{{ old('tgl_lhr', $data['tgl_lahir']) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"
                                    for="input-stat-kawin">{{ __('Status Perkawinan') }}<span
                                        style="color:red;">*</span></label>
                                <select class="custom-select" name="status_nikah" id="input-stat-kawin">
                                    <option disabled
                                        {{ is_null($data['status_pernikahan']) || empty($data['status_pernikahan']) ? 'selected' : '' }}>
                                        -- Pilih Status Pernikahan --</option>
                                    <option value="Belum Nikah"
                                        {{ $data['status_pernikahan'] == 'Belum Menikah' ? 'selected' : '' }}>Belum
                                        Menikah</option>
                                    <option value="Menikah"
                                        {{ $data['status_pernikahan'] == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Janda/Duda"
                                        {{ $data['status_pernikahan'] == 'Janda/Duda' ? 'selected' : '' }}>Janda/Duda
                                    </option>
                                    <option value="Cerai/Pisah"
                                        {{ $data['status_pernikahan'] == 'Cerai/Pisah' ? 'selected' : '' }}>Cerai/Pisah
                                    </option>
                                </select>
                            </div>

                            <div class="form-group{{ $errors->has('profesi') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-profesi">{{ __('Profesi') }}</label>
                                <input type="text" name="profesi" id="input-profesi"
                                    class="form-control form-control-alternative{{ $errors->has('profesi') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Profesi') }}" value="{{ old('profesi', $data['profesi']) }}">

                                @if ($errors->has('profesi'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('profesi') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('nama_ibu') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nama-ibu">{{ __('Nama Ibu') }}</label>
                                <input type="text" name="nama_ibu" id="input-nama-ibu"
                                    class="form-control form-control-alternative{{ $errors->has('nama_ibu') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Nama Ibu') }}" value="{{ old('nama_ibu', $data['nama_ibu']) }}">

                                @if ($errors->has('nama_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_ibu') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('nama_ayah') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nama-ayah">{{ __('Nama Ayah') }}</label>
                                <input type="text" name="nama_ayah" id="input-nama-ayah"
                                    class="form-control form-control-alternative{{ $errors->has('nama_ayah') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Nama Ayah') }}"
                                    value="{{ old('nama_ayah', $data['nama_ayah']) }}">

                                @if ($errors->has('nama_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                </span>
                                @endif
                            </div>

                            @if(!Auth::user()->can('superadmin'))
                            <div class="form-group">
                                <label class="form-control-label" for="input-loc-ibadah">
                                    @if(Auth::user()->can('admin') || Auth::user()->can('KAJ_leader') ||
                                    Auth::user()->can('KOM_leader') || Auth::user()->can('baptis_leader'))
                                    Cabang Gereja
                                    @else
                                    Lokasi Ibadah
                                    @endif
                                </label>
                                @if(Auth::user()->can('admin') || Auth::user()->can('KAJ_leader') ||
                                Auth::user()->can('KOM_leader') || Auth::user()->can('baptis_leader'))
                                <input type="text" readonly class="form-control-plaintext" id="input-loc-ibadah"
                                    name="cabang"
                                    value="{{ old('cabang', auth()->user()->jemaat->cabangGerejaTrashed ? auth()->user()->jemaat->cabangGerejaTrashed->nama_gereja : '-') }}">
                                <input type="hidden" name="lokasi_ibadah"
                                    value="{{ old('lokasi_ibadah', auth()->user()->jemaat->cabangGerejaTrashed ? auth()->user()->jemaat->cabangGerejaTrashed->id : '-') }}">
                                @else
                                <select class="custom-select" name="lokasi_ibadah" id="input-loc-ibadah">
                                    <option disabled selected>-- Pilih Lokasi Ibadah --</option>
                                    <option value="">Belum Ada</option>
                                    @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}"
                                        {{ old('lokasi_ibadah', auth()->user()->jemaat->lokasi_ibadah == $cabang->id ? 'selected' : '') }}>
                                        {{ $cabang->nama_gereja }}</option>
                                    @endforeach
                                </select>
                                @endif

                            </div>
                            @endif

                            @if(Auth::user()->can('basic_congregation') || Auth::user()->can('FA_leader'))
                            <div class="form-group{{ $errors->has('no_fa') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-no-fa">{{ __('No. Family Altar') }}</label>
                                <input type="text" name="no_fa" id="input-no-fa"
                                    class="form-control form-control-alternative{{ $errors->has('no_fa') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('No. Familiy Altar') }}"
                                    value="{{ old('no_fa', $data->fa ? $data->fa->FA_number : '') }}" disabled>

                                @if ($errors->has('nama_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('E-mail') }}</label>
                                <input type="email" name="email" id="input-email"
                                    class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('E-mail') }}" value="{{ old('email', auth()->user()->email) }}"
                                    disabled>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            @unless(Auth::user()->can('admin') || Auth::user()->can('superadmin') ||
                            Auth::user()->can('KAJ_leader') || Auth::user()->can('KOM_leader') ||
                            Auth::user()->can('baptis_leader'))
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="staticKAJ" class="form-control-label">Status KAJ</label>
                                    <input type="text" readonly class="text-muted form-control-plaintext" id="staticKAJ"
                                        value="{{ $data->kaj ? $data->kaj->status : 'Tidak ada KAJ' }}">
                                    <div class="custom-file">
                                        <label id="label_kaj" class="custom-file-label" for="kajFile">Upload KAJ</label>
                                        <input type="file" name="img_kaj" class="custom-file-input" id="kajFile"
                                            accept="image/*" onchange="readURL(this, 0);">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="staticBaptis" class="form-control-label">Status Sertifikat
                                        Baptis</label>
                                    <input type="text" readonly class="text-muted form-control-plaintext"
                                        id="staticBaptis"
                                        value="{{ $data->baptis ? $data->baptis->status : 'Tidak ada Sertifikat Baptis' }}">
                                    <div class="custom-file">
                                        <label id="label_baptis" class="custom-file-label" for="baptisFile">Upload
                                            Sertifikat Baptis</label>
                                        <input type="file" name="img_baptis" class="custom-file-input" id="baptisFile"
                                            accept="image/*" onchange="readURL(this, 1);">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="staticKOM" class="form-control-label">Status Sertifikat KOM 100</label>
                                    <input type="text" readonly class="text-muted form-control-plaintext" id="staticKOM"
                                        value="{{ $data->kom ? $data->kom->status : 'Tidak ada Sertifikat KOM' }}">
                                    <div class="custom-file">
                                        <label id="label_kom100" class="custom-file-label" for="komFile">Upload
                                            KOM 100</label>
                                        <input type="file" name="img_kom_100" class="custom-file-input" id="komFile100"
                                            accept="image/*" onchange="readURL(this, 2);">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="staticKOM" class="form-control-label">Status Sertifikat KOM 200</label>
                                    <input type="text" readonly class="text-muted form-control-plaintext" id="staticKOM"
                                        value="{{ $data->kom ? $data->kom->status : 'Tidak ada Sertifikat KOM' }}">
                                    <div class="custom-file">
                                        <label id="label_kom200" class="custom-file-label" for="komFile">Upload
                                            KOM 200</label>
                                        <input type="file" name="img_kom_200" class="custom-file-input" id="komFile200"
                                            accept="image/*" onchange="readURL(this, 3);">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="staticKOM" class="form-control-label">Status Sertifikat KOM 300</label>
                                    <input type="text" readonly class="text-muted form-control-plaintext" id="staticKOM"
                                        value="{{ $data->kom ? $data->kom->status : 'Tidak ada Sertifikat KOM' }}">
                                    <div class="custom-file">
                                        <label id="label_kom300" class="custom-file-label" for="komFile">Upload
                                            KOM 300</label>
                                        <input type="file" name="img_kom_300" class="custom-file-input" id="komFile300"
                                            accept="image/*" onchange="readURL(this, 4);">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="staticKOM" class="form-control-label">Status Sertifikat KOM 400</label>
                                    <input type="text" readonly class="text-muted form-control-plaintext" id="staticKOM"
                                        value="{{ $data->kom ? $data->kom->status : 'Tidak ada Sertifikat KOM' }}">
                                    <div class="custom-file">
                                        <label id="label_kom400" class="custom-file-label" for="komFile">Upload
                                            KOM 400</label>
                                        <input type="file" name="img_kom_400" class="custom-file-input" id="komFile400"
                                            accept="image/*" onchange="readURL(this, 5);">
                                    </div>
                                </div>
                            </div>
                            @endunless

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Simpan') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4">
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                        @if (session('password_status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('password_status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <label class="form-control-label"
                                    for="input-current-password">{{ __('Current Password') }}</label>
                                <input type="password" name="old_password" id="input-current-password"
                                    class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Current Password') }}" value="" required>

                                @if ($errors->has('old_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                <input type="password" name="password" id="input-password"
                                    class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('New Password') }}" value="" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                <input type="password" name="password_confirmation" id="input-password-confirmation"
                                    class="form-control form-control-alternative"
                                    placeholder="{{ __('Confirm New Password') }}" value="" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
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
    $(function () {
        $("#input-tgl-lhr").datepicker({
            format: 'yyyy-mm-dd',
            endDate: '0d',
        });
    });

    function removeFile($i) {
        if ($i == 0) {
            document.getElementById("img_kaj").value = "";
            $('#img_kaj').attr('src', 'https://via.placeholder.com/150');
        }
        // else {
        //     document.getElementById("cover_pic").value = "";
        //     $('#img_cover_pic').attr('src', 'https://via.placeholder.com/150');
        // }
    }

    function readURL(input, $i) {
        if ($i == 0) {
            var fullPath = document.getElementById("kajFile").value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');
            $('#label_kaj').html(filename);

        } else if ($i == 1) {
            var fullPath = document.getElementById("baptisFile").value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');
            $('#label_baptis').html(filename);
        } else if ($i == 2) {
            var fullPath = document.getElementById("komFile100").value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');
            $('#label_kom100').html(filename);
        } else if ($i == 3) {
            var fullPath = document.getElementById("komFile200").value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');
            $('#label_kom200').html(filename);
        } else if ($i == 4) {
            var fullPath = document.getElementById("komFile300").value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');
            $('#label_kom300').html(filename);
        } else if ($i == 5) {
            var fullPath = document.getElementById("komFile400").value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');
            $('#label_kom400').html(filename);
        }
    }
</script>
@endpush