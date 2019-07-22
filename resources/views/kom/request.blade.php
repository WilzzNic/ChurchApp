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
                    <form class="px-5" method="post" action="{{ route('bcon.requestkom.send') }}" autocomplete="off">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissable fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        <div class="form-group">
                            <label class="form-control-label" for="input-cabang">{{ __('Cabang') }}</label>
                            <select class="form-control js-example-responsive" name="cabang" id="input-cabang">
                                <option value="0">-- Pilih Cabang --</option>
                                @foreach($cab_gerejas as $cab_gereja)
                                    <option value="{{ $cab_gereja->id }}">{{ $cab_gereja->nama_gereja }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="input-seri">{{ __('Seri KOM') }}</label>
                            <select class="custom-select" name="seri" id="input-seri">
                                <option value="0" disabled selected>-- Pilih Seri --</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-asal-gereja">{{ __('Asal Gereja') }}</label>
                            <input id="input-asal-gereja" class="form-control form-control-alternative" name="asal_gereja"
                            value="{{ auth()->user()->jemaat->cabangGereja ? auth()->user()->jemaat->cabangGereja->nama_gereja : ''}}"
                            placeholder="Asal Gereja" type="text" required>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-control-label" for="input-jadwal">{{ __('Tanggal KOM') }}</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input id="input-jadwal" class="form-control datepicker" name="tanggal" placeholder="Tanggal" type="text" required disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label" for="input-waktu">{{ __('Waktu KOM') }}</label>
                                <select class="custom-select" name="waktu" id="input-waktu" disabled>
                                    <option value="0" disabled selected>-- Pilih Waktu KOM --</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Daftar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-responsive').select2({
            placeholder: 'Pilih Cabang Gereja',
            width: 'resolve',
        });
    });

    $('#input-cabang').on('change', function(e) {
        $.ajax({
            type: "POST",
            url: "{{ route('bcon.requestkom.schedule') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cabang": $('#input-cabang').val(),
                "seri"  : $('#input-seri').val(),
            }
        }).done(function(messages) {
            $('#input-waktu').children('option:not(:first)').remove();

            if(messages == null || messages.length < 1) {
                $('.datepicker').prop('disabled', true);
                $('#input-waktu').prop('disabled', true);
            }
            else {
                $('.datepicker').prop('disabled', false);
                $('#input-waktu').prop('disabled', false);

                var haris = [];

                messages.forEach(function(jadwal) {
                    if(jadwal.hari == "Minggu") {
                        haris.push(0);
                    }
                    else if(jadwal.hari == "Senin") {
                        haris.push(1);
                    }
                    else if(jadwal.hari == "Selasa") {
                        haris.push(2);
                    }
                    else if(jadwal.hari == "Rabu") {
                        haris.push(3);
                    }
                    else if(jadwal.hari == "Kamis") {
                        haris.push(4);
                    } 
                    else if(jadwal.hari == "Jumat") {
                        haris.push(5);
                    } 
                    else if(jadwal.hari == "Sabtu") {
                        haris.push(6);
                    }

                    $("#input-waktu").append(
                        new Option(moment(jadwal.waktu, "HH:mm:ss").format("HH:mm"), jadwal.id)
                    );
                });

                calendar_set = full_set.diff(haris);

                $(".datepicker").datepicker("setDaysOfWeekDisabled", calendar_set);
            }
        });
    });

    Array.prototype.diff = function(a) {
        return this.filter(function(i) {return a.indexOf(i) < 0;});
    };


    $('#input-seri').change(function() {
        $.ajax({
            type: "POST",
            url: "{{ route('bcon.requestkom.schedule') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cabang": $('#input-cabang').val(),
                "seri"  : $('#input-seri').val(),
            }
        }).done(function(messages) {
            $('#input-waktu').children('option:not(:first)').remove();

            if(messages == null || messages.length < 1) {
                $('.datepicker').prop('disabled', true);
                $('#input-waktu').prop('disabled', true);
            }
            else {
                $('.datepicker').prop('disabled', false);
                $('#input-waktu').prop('disabled', false);

                var haris = [];

                messages.forEach(function(jadwal) {
                    if(jadwal.hari == "Minggu") {
                        haris.push(0);
                    }
                    else if(jadwal.hari == "Senin") {
                        haris.push(1);
                    }
                    else if(jadwal.hari == "Selasa") {
                        haris.push(2);
                    }
                    else if(jadwal.hari == "Rabu") {
                        haris.push(3);
                    }
                    else if(jadwal.hari == "Kamis") {
                        haris.push(4);
                    } 
                    else if(jadwal.hari == "Jumat") {
                        haris.push(5);
                    } 
                    else if(jadwal.hari == "Sabtu") {
                        haris.push(6);
                    }

                    $("#input-waktu").append(new Option(moment(jadwal.waktu, "HH:mm:ss").format("HH:mm"), jadwal.id));
                });

                calendar_set = full_set.diff(haris);

                $(".datepicker").datepicker("setDaysOfWeekDisabled", calendar_set);
            }
        });
    });

    var full_set = [0,1,2,3,4,5,6];
    var calendar_set = [1,2,3,4,5,6];

    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: calendar_set,
            startDate: '+0d',
        });
    });
</script>
@endpush