@extends('layouts.app', ['title' => __('Pelayanan KOM')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman untuk melihat detil KOM yang sedang di-enroll.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size:50pt;"><i class="ni ni-hat-3"></i></h1>
                        <h3 class="text-center col-12 mb-3">{{ __('Pelayanan KOM') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">Di bawah merupakan detil permohonan KOM.</p>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bcon.requestkom.delete', ['id' => $request->id]) }}">
                        @csrf
                        @method('DELETE')

                        <div class="row">
                            <div class="col">
                                @if($request->status == 'Pending')
                                <div class="alert alert-default" role="alert">
                                    <strong>Permohonan anda telah dikirim!</strong> Mohon menunggu konfirmasi dari
                                    Admin.
                                </div>
                                @elseif($request->status == 'Enrolling')
                                <div class="alert alert-success" role="alert">
                                    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-inner--text"><strong>Selamat!</strong>
                                        Anda sedang menjalani modul {{ $request->jadwal->seri_kom }}.</span>
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
                            <label for="staticAsal" class="col-sm-2 col-form-label">Asal Gereja:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticAsal"
                                    value="{{ $request->asal_gereja }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticTanggal" class="col-sm-2 col-form-label">Tanggal Kelas:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticTanggal"
                                    value="{{ $request->tanggal }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticWaktu" class="col-sm-2 col-form-label">Waktu:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticWaktu"
                                    value="{{ date('H:i', strtotime($request->jadwal->waktu)) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticStatus" class="col-sm-2 col-form-label">Status:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticStatus"
                                    value="{{ $request->status }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticCreatedAt" class="col-sm-2 col-form-label">Tanggal Permohonan:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticCreatedAt"
                                    value="{{ date('Y-m-d', strtotime($request->created_at)) }}">
                            </div>
                        </div>

                        @if($request->status == 'Pending')
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger mt-4">
                                Batal
                            </button>
                        </div>
                        @elseif ($request->status == 'Enrolling')
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger mt-4">
                                Berhenti Enroll
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