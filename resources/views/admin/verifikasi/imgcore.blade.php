@extends('layouts.app', ['title' => __('Verifikasi Baptis')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman Verifikasi Baptis.'),
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="ni ni-paper-diploma"></i></h1>
                        <h3 class="text-center col-12 mb-5">
                            {{ __('Verifikasi Sertifikat Baptis') }}
                        </h3>
                    </div>
                </div>

                <div class="text-center card-body">
                    <img src="{{ asset("storage/$data->img_path") }}" id="img-core" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
