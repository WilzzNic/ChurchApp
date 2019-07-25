@extends('layouts.app', ['title' => __('Pelayanan KAJ')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
'description' => __('Ini adalah halaman untuk mengajukan pembuatan Kartu Anggota Jemaat.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12"><i class="ni ni-badge"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Pelayanan Kartu Anggota Jemaat') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">
                            Daftarkan diri Anda untuk mendapatkan Kartu Anggota Jemaat.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @if(auth()->user()->jemaat->status == App\Jemaat::STATUS_VERIFIED && auth()->user()->jemaat->baptis->status == App\Baptis::STATUS_VERIFIED)
                    <form class="px-5" method="GET" action="{{ route('bcon.requestkaj.send') }}" autocomplete="off">
                        @csrf

                        @if(!auth()->user()->jemaat->requestKAJ)
                        <div class="form-group">
                            <div class="row">
                                <div class="col text-center">
                                    <h4>Selamat!</h4>
                                    <p>Data anda telah terverifikasi dan telah memenuhi syarat untuk mengajukan <b>Kartu
                                            Anggota Jemaat.</b></p>
                                    <h1><i class="ni ni-satisfied"></i></h1>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Ajukan Pembuatan KAJ') }}</button>
                        </div>
                        @else
                        <div class="px-5">
                            <div class="row">
                                <div class="col text-center">
                                    <h4>Terima kasih</h4>
                                    <p>Tim pelayanan KAJ akan menghubungi anda dalam 3 x 24 jam.</p>
                                    <h1><i class="fa fa-clock"></i></h1>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                    @endif

                    @if(Auth::user()->can('basic_congregation') || Auth::user()->can('FA_leader'))
                    <div class="px-5">
                        <div class="row">
                            <div class="col text-center">
                                <h4>Data Anda Tidak Lengkap atau Sedang Diverifikasi</h4>
                                <p>Untuk dapat menggunakan pelayanan, Anda harus mengisi data <b>General Description</b>
                                    dan <b>mengupload sertifikat baptis</b>.</p>
                                <h1><i class="fa fa-spinner"></i></h1>
                            </div>
                        </div>
                    </div>
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
    $(function () {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: [1, 2, 3, 4, 5, 6],
            startDate: '+0d',
        });
    });
</script>
@endpush