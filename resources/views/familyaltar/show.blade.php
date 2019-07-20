@extends('layouts.app', ['title' => __('Family Altar')])

<meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <h1 class="text-center col-12"><i class="fa fa-users"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Family Altar') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">
                            Ayo bergabung dan tumbuh bersama Family Altar. Temuka Family Altar terdekat dengan lingkungan saudara.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @can('basic_congregation')
                    <form class="px-5" autocomplete="off">

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        
                        <div class="form-group row">
                            <label for="staticOwner" class="col-sm-2 col-form-label">Owner</label>
                            <div class="col-sm-10">
                                <b>
                                    <input type="text" readonly class="form-control-plaintext"
                                    id="staticOwner" value="{{ auth()->user()->jemaat->requestAltar->fa->owner->nama }}">
                                </b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticStatus" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                </b>
                                    <input type="text" readonly class="form-control-plaintext"
                                    id="staticStatus" value="{{ auth()->user()->jemaat->requestAltar->status }}">
                                </b>
                            </div>
                        </div>

                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection