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
                        
                        <div class="form-group">
                            <label class="form-control-label" for="input-daerah">{{ __('Daerah') }}</label>
                            <select class="custom-select" name="daerah" id="input-daerah">
                                <option selected disabled>-- Pilih Daerah --</option>
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
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

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 5,
            scrollX: true,
            ajax: "{{ route('bcon.altardt') }}",
            columns: [
                { name: 'FA_number' },
                { name: 'owner.nama', orderable: false },
                { name: 'daerah.nama_daerah', orderable: false },
                { name: 'action', orderable: false, searchable: false }
            ],
        });

        $('#input-daerah').change(function() {
            t.destroy();
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
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
                columns: [
                    { name: 'FA_number' },
                    { name: 'owner.nama', orderable: false },
                    { name: 'daerah.nama_daerah', orderable: false },
                    { name: 'action', orderable: false, searchable: false }
                ],
            });
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