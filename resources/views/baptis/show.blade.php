@extends('layouts.app', ['title' => __('Request List')])

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->jemaat->nama,
'description' => __('Ini adalah halaman untuk melihat permohonan baptis.'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">

    <!-- Modal -->
    <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('leader.approve.baptis') }}" class="form-inline" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <label for="input-waktu" class="sr-only">Waktu</label>
                            <input type="time" class="form-control" id="input-waktu" name="waktu">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h1 class="text-center col-12" style="font-size: 50pt;"><i class="fa fa-paper-plane"></i></h1>
                        <h3 class="text-center col-12">{{ __('Request List') }}</h3>
                    </div>
                </div>
                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-default alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table id="table" class="uk-table uk-table-hover uk-table-striped" style="width:100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Tanggal Permohonan Dikirim</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Jemaat</th>
                                    <th scope="col">Tanggal Dibaptis</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            ajax: "{{ route('leader.request.show.dt') }}",
            columnDefs: [
                {
                    targets: 0,
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD H:m:s', 'YYYY-MM-DD'),
                },
            ],
            order: [
                [0, 'asc']
            ],
            columns: [
                {
                    name: 'created_at'
                },
                {
                    name: 'email',
                    orderable: false,
                },
                {
                    name: 'jemaat.nama'
                },
                {
                    name: 'tanggal'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });

        $('#modalApprove').on('show.bs.modal', function (e) {
            var request = $(e.relatedTarget).data('request');
            $('#id').val(request);
        });
    });
</script>
@endpush