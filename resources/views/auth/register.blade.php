@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <div class="text-center">
                            <h1>Daftar Akun</h1>
                        </div>
                        {{-- <div class="text-muted text-center mt-2 mb-4"><small>{{ __('Sign up with') }}</small></div>
                        <div class="text-center">
                            <a href="#" class="btn btn-neutral btn-icon mr-4">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">{{ __('Github') }}</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">{{ __('Google') }}</span>
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        {{-- <div class="text-center text-muted mb-4">
                            <small>{{ __('Or sign up with credentials') }}</small>
                        </div> --}}
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="form-group">
                                <div class="text-center">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="jenis_kelamin" class="custom-control-input" id="customRadio1" checked type="radio" value="L">
                                        <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="jenis_kelamin" class="custom-control-input" id="customRadio2" type="radio" value="P">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Lengkap') }}" type="text" name="nama" value="{{ old('name') }}" required autofocus>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- <div class="form-group{{ $errors->has('no_hp') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i> &nbsp; +62</span>
                                    </div>
                                    <input class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" placeholder="{{ __('No. HP') }}" type="tel" name="no_hp" value="{{ old('no_hp') }}" required>
                                </div>
                                @if ($errors->has('no_hp'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('no_hp') }}</strong>
                                    </span>
                                @endif
                            </div> --}}
                            {{-- <div class="form-group">
                                <select class="custom-select" name="status_nikah">
                                    <option disabled selected>Status Pernikahan</option>
                                    <option value="Belum Nikah">Belum Menikah</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Janda/Duda">Janda/Duda</option>
                                    <option value="Cerai/Pisah">Cerai/Pisah</option>
                                </select>
                            </div> --}}
                            {{-- <div class="form-group">
                                <textarea class="form-control form-control-alternative" 
                                rows="3" name="alamat" placeholder="Tulis alamat lengkap di sini.."></textarea>
                            </div> --}}
                            <div class="form-group">
                                {{-- <div class="col">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-planet"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('tmpt_lhr') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat Lahir') }}" type="text" name="tmpt_lhr" value="{{ old('tmpt_lhr') }}" required>
                                    </div>
                                    @if ($errors->has('tmpt_lhr'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('tmpt_lhr') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}
                                {{-- <div class="col"> --}}
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" name="tgl_lhr" placeholder="Tanggal Lahir" type="text">
                                    </div>
                                {{-- </div> --}}
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Kata Sandi') }}" type="password" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Konfirmasi Kata Sandi') }}" type="password" name="password_confirmation" required>
                                </div>
                            </div>
        
                            {{-- <div class="text-muted font-italic">
                                <small>{{ __('password strength') }}: <span class="text-success font-weight-700">{{ __('strong') }}</span></small>
                            </div> --}}
                            {{-- <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">{{ __('I agree with the') }} <a href="#!">{{ __('Privacy Policy') }}</a></span>
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Daftar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            endDate: '0d',
        });
    });
</script>
@endpush


        


