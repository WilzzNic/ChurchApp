@extends('layouts.app', ['title' => __('Pelayanan Baptis')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Ini adalah halaman bagi Anda untuk mengajukan Baptis.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12"><i class="fa fa-tint"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Pelayanan Baptis') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">Bagi Anda yang membutuhkan pelayanan baptisan dapat mengisi form di bawah ini.</p>
                    </div>
                </div>
                <div class="card-body">
                    @if(auth()->user()->jemaat->lokasi_ibadah)
                        <form class="px-5" method="post" action="{{ route('bcon.requestbaptis.send') }}" autocomplete="off">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group {{ $errors->has('tanggal') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-tgl">{{ __('Tanggal Baptis') }}</label>
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
                                <button type="submit" class="btn btn-success mt-4">{{ __('Kirim Permohonan') }}</button>
                            </div>
                        </form>
                    @else
                        <div class="px-5">
                            <div class="row">
                                <div class="col text-center">
                                    <h4>Apakah Anda merupakan jemaat salah di salah satu cabang gereja Yayasan Surya Kebenaran Indonesia?</h4>
                                    <p>Jika iya, Anda harus mengisi kolom <b>Lokasi Ibadah</b> di <b>General Description</b> untuk dapat mengajukan baptis.</p>
                                    <h1><i class="fa fa-spinner"></i></h1>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: [1,2,3,4,5,6],
            startDate: '+0d',
        });
    });
</script>
@endpush