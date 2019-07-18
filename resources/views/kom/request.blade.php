@extends('layouts.app', ['title' => __('KOM')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->email,
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
                        <h1 class="text-center col-12"><i class="ni ni-hat-3"></i></h1>
                        <h3 class="text-center col-12 mb-5">{{ __('Pelayanan Kelas Orientasi Melayani') }}</h3>
                        <p class="text-muted text-center col-12 mb-0">
                            Perlengkapi diri Anda untuk mempelajari Firman Tuhan dengan mengikuti kelas KOM.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @can('basic_congregation')
                    <form class="px-5" method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label class="form-control-label" for="input-cabang">{{ __('Cabang') }}</label>
                                <select class="custom-select" name="cabang" id="input-cabang">
                                    <option>GBI - Medan Plaza</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label" for="input-seri">{{ __('Seri KOM') }}</label>
                                <select class="custom-select" name="seri" id="input-seri">
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-jadwal">{{ __('Jadwal KOM') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input id="input-jadwal" class="form-control datepicker" name="tanggal" placeholder="Tanggal" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-asal-gereja">{{ __('Asal Gereja') }}</label>
                            <input id="input-asal-gereja" class="form-control form-control-alternative" name="asal_gereja" placeholder="Asal Gereja" type="text">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Daftar') }}</button>
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