@extends('layouts.app', ['title' => __('Pelayanan Baptis')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman detil pengajuan Baptis Anda.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12"><i class="fa fa-tint"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Pelayanan Baptis') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">Di bawah merupakan status permohonan Baptis Anda.</p>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bcon.requestbaptis.delete', ['id' => $request->id]) }}">
                        @csrf
                        @method('DELETE')

                        <div class="row">
                            <div class="col">
                                @if($request->status == 'Pending')
                                <div class="alert alert-default" role="alert">
                                    <strong>Permohonan anda telah dikirim!</strong> Mohon menunggu konfirmasi dari
                                    Admin.
                                </div>
                                @elseif($request->status == 'Accepted')
                                <div class="alert alert-success" role="alert">
                                    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-inner--text"><strong>Permohonan anda telah diterima!</strong>
                                        Mohon datang pada waktu yang telah ditentukan.</span>
                                </div>
                                @else
                                <div class="alert alert-success" role="alert">
                                    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-inner--text"><strong>Permohonan anda ditolak</strong>
                                        Silakan mengajukan kembali permohonan baptis.</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Nama:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticName"
                                    value="{{ $request->jemaat->nama }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticTanggal" class="col-sm-2 col-form-label">Tanggal Baptis:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticTanggal"
                                    value="{{ $request->tanggal }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticWaktu" class="col-sm-2 col-form-label">Waktu Baptis:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticWaktu"
                                    value="{{ is_null($request->waktu) ? '-' : date('H:i', strtotime($request->waktu))}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticStatus" class="col-sm-2 col-form-label">Status:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticStatus"
                                    value="{{ $request->status }}">
                            </div>
                        </div>

                        @if($request->status == 'Pending')
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger mt-4">
                                Batal
                            </button>
                        </div>
                        @elseif ($request->status == 'Rejected')
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">
                                Ajukan Ulang
                            </button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection