@extends('layouts.app', ['title' => __('Pelayanan Baptis')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->name,
'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your
projects or assigned tasks'),
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
                    @can('basic_congregation')
                        @if(!auth()->user()->jemaat->requestBaptis)
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
                        <form>
                            <div class="row">
                                <div class="col">
                                    @if(auth()->user()->jemaat->requestBaptis->status == 'Pending')
                                        <div class="alert alert-default" role="alert">
                                            <strong>Permohonan anda telah dikirim!</strong> Mohon menunggu konfirmasi dari Admin.
                                        </div>
                                    @elseif(auth()->user()->jemaat->requestBaptis->status == 'Accepted')
                                        <div class="alert alert-primary" role="alert">
                                            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                            <span class="alert-inner--text"><strong>Permohonan anda telah diterima!</strong> Mohon datang pada waktu yang telah ditentukan.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticName" class="col-sm-2 col-form-label">Nama:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticName" value="{{ auth()->user()->jemaat->nama }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticTanggal" class="col-sm-2 col-form-label">Tanggal Baptis:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticTanggal" value="{{ auth()->user()->jemaat->requestBaptis->tanggal }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticWaktu" class="col-sm-2 col-form-label">Waktu Baptis:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticWaktu" value="{{ is_null(auth()->user()->jemaat->requestBaptis->waktu) ? '-' : auth()->user()->jemaat->requestBaptis->waktu}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticStatus" class="col-sm-2 col-form-label">Status:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticStatus" value="{{ auth()->user()->jemaat->requestBaptis->status }}">
                                </div>
                            </div>
                        </form>

                        @endif

                    @endcan
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