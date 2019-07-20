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
                            Ayo bergabung dan tumbuh bersama Family Altar. Temukan Family Altar terdekat dengan lingkungan saudara.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @can('basic_congregation')
                        @if(!auth()->user()->jemaat->requestAltar)
                            <form class="px-5" autocomplete="off">

                                @if (session('status'))
                                    <div class="alert alert-danger alert-success fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label class="form-control-label" for="input-daerah">{{ __('Daerah') }}</label>
                                    <select class="custom-select" name="daerah" id="input-daerah">
                                        <option value="0" selected>Semua Daerah</option>
                                        @foreach($daerahs as $daerah)
                                            <option value="{{ $daerah->id }}">{{ $daerah->nama_daerah }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">No. FA</th>
                                                    <th scope="col">Owner</th>
                                                    <th scope="col">Daerah</th>
                                                    <th scope="col">Hari</th>
                                                    <th scope="col">Waktu</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form class="px-5" method="POST" action="{{ route('bcon.requestfa.leave', ['id' => auth()->user()->jemaat->requestAltar->id]) }}">
                                @csrf
                                @method('DELETE')

                                @if (session('status'))
                                    <div class="alert alert-danger alert-success fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


                                <div class="form-group row">
                                    <label for="staticAltarNum" class="col-sm-2 col-form-label"><b>No. Family Altar</b></label>
                                    <div class="col-sm-10">
                                        <b>
                                            <input type="text" readonly class="form-control-plaintext"
                                            id="staticAltarNum" value="{{ auth()->user()->jemaat->requestAltar->fa->FA_number }}">
                                        </b>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticOwner" class="col-sm-2 col-form-label"><b>Owner</b></label>
                                    <div class="col-sm-10">
                                        <b>
                                            <input type="text" readonly class="form-control-plaintext"
                                            id="staticOwner" value="{{ auth()->user()->jemaat->requestAltar->fa->owner->nama }}">
                                        </b>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticAlamat" class="col-sm-2 col-form-label"><b>Alamat</b></label>
                                    <div class="col-sm-10">
                                        </b>
                                            <input type="text" readonly class="form-control-plaintext"
                                            id="staticAlamat" value="{{ auth()->user()->jemaat->requestAltar->fa->alamat }}, {{ auth()->user()->jemaat->requestAltar->fa->daerah->nama_daerah }}">
                                        </b>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticJadwal" class="col-sm-2 col-form-label"><b>Jadwal</b></label>
                                    <div class="col-sm-10">
                                        </b>
                                            <input type="text" readonly class="form-control-plaintext"
                                            id="staticJadwal" value="{{ auth()->user()->jemaat->requestAltar->fa->hari }}, pukul {{ date('H:i', strtotime(auth()->user()->jemaat->requestAltar->fa->waktu)) }}">
                                        </b>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="staticStatus" class="col-sm-2 col-form-label"><b>Status</b></label>
                                    <div class="col-sm-10">
                                        </b>
                                            <input type="text" readonly class="form-control-plaintext"
                                            id="staticStatus" value="{{ auth()->user()->jemaat->requestAltar->status }}">
                                        </b>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticCreatedAt" class="col-sm-2 col-form-label"><b>Dikirim pada tanggal</b></label>
                                    <div class="col-sm-10">
                                        </b>
                                            <input type="text" readonly class="form-control-plaintext"
                                            id="staticCreatedAt" value="{{ date('Y-m-d', strtotime(auth()->user()->jemaat->requestAltar->created_at)) }}">
                                        </b>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger mt-4">{{ __('Keluar dari Altar') }}</button>
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
    $(document).ready(function() {
        // var t = $('#table').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     pageLength: 10,
        //     scrollX: true,
        //     ajax: "{{ route('bcon.altardt') }}",
        //     columnDefs: [
        //         {
        //             targets: 4,
        //             render: $.fn.dataTable.render.moment('H:m:s','HH:mm'),
        //         }
        //     ],
        //     columns: [
        //         { name: 'FA_number' },
        //         { name: 'owner.nama', orderable: false },
        //         { name: 'daerah.nama_daerah', orderable: false },
        //         { name: 'hari', orderable: false },
        //         { name: 'waktu', orderable: false },
        //         { name: 'action', orderable: false, searchable: false }
        //     ],
        // });

        var dt = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            ajax: {
                url: "{{ route('bcon.altardt.daerah') }}",
                type: "POST",
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : function (d) {
                    d.daerah = $('#input-daerah').val()
                }
            },
            columnDefs: [
                {
                    targets: 4,
                    render: $.fn.dataTable.render.moment('H:m:s','HH:mm'),
                }
            ],
            columns: [
                { name: 'FA_number' },
                { name: 'owner.nama', orderable: false },
                { name: 'daerah.nama_daerah', orderable: false },
                { name: 'hari', orderable: false },
                { name: 'waktu', orderable: false },
                { name: 'action', orderable: false, searchable: false }
            ],
        });

        $('#input-daerah').change(function() {
            dt.ajax.reload();
        });
    });

    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: [1,2,3,4,5,6],
            startDate: '+0d',
        });
    });
</script>
@endpush