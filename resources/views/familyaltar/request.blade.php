@extends('layouts.app', ['title' => __('Family Altar')])

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
                    <form class="px-5" method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-control-label" for="input-daerah">{{ __('Daerah') }}</label>
                            <select class="custom-select" name="daerah" id="input-daerah">
                                <option>Medan Johor</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-tgl">{{ __('Tanggal Baptis') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" id="input-tgl" name="tanggal" placeholder="Tanggal" type="text" value="{{ old('tanggal') }}">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Kirim Permohonan') }}</button>
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