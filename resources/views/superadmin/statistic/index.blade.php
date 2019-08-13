@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row mb-2">
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Jumlah Permohonan Baptis</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                        <span class="d-none d-md-block">Bulan</span>
                                        <span class="d-md-none">Bulan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="baptis-chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Jumlah Permohonan Kartu Anggota Jemaat</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                        <span class="d-none d-md-block">Bulan</span>
                                        <span class="d-md-none">Bulan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="kaj-chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Jumlah Permohonan Kelas Orientasi Melayani</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                        <span class="d-none d-md-block">Bulan</span>
                                        <span class="d-md-none">Bulan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="kom-chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Jumlah Permohonan Family Altar</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                        <span class="d-none d-md-block">Bulan</span>
                                        <span class="d-md-none">Bulan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="altar-chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-xl-center mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="text-center mb-0">Data Jemaat</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="ui celled table" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="all" scope="col">ID</th>
                                <th class="all" scope="col">Nama Jemaat</th>
                                <th class="all" scope="col">No. FA</th>
                                <th class="all" scope="col">Jenis Kelamin</th>
                                <th class="all" scope="col">Tempat Lahir</th>
                                <th class="all" scope="col">Tanggal Lahir</th>
                                <th class="all" scope="col">Profesi</th>
                                <th class="all" scope="col">Status Nikah</th>
                                <th class="all" scope="col">No. HP</th>
                                <th class="all" scope="col">Alamat</th>
                                <th class="all" scope="col">Lokasi Ibadah</th>
                                <th class="all" scope="col">Nama Ibu</th>
                                <th class="all" scope="col">Nama Ayah</th>
                                <th class="all" scope="col">Status Akun</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('css')
<style>
    thead th {
        white-space: nowrap;
    }

    .ui.table td {
        padding:  !important .92857143em .78571429em;
        text-align: inherit;
    }

    .ui.grid {
        margin-top: 0rem;
        margin-bottom: 0rem;
        margin-left: 0rem;
        margin-right: -2rem;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script type="text/javascript">
    var baptis_canvas = document.getElementById('baptis-chart');
    var kaj_canvas = document.getElementById('kaj-chart');
    var kom_canvas = document.getElementById('kom-chart');
    var altar_canvas = document.getElementById('altar-chart');

    var baptis_requests = {{json_encode($baptis_requests, JSON_HEX_TAG)}};
    var kaj_requests = {{json_encode($kaj_requests, JSON_HEX_TAG)}};
    var kom_requests = {{json_encode($kom_requests, JSON_HEX_TAG)}};
    var altar_requests = {{json_encode($altar_requests, JSON_HEX_TAG)}};

    var bulans =  ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep",
            "Oct","Nov", "Dec"];

    var option = {
        legend: {
            display: false
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem) {
                    return tooltipItem.yLabel;
                }
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 10,
                }
            }]
        },
        animation: {
            duration: 5000
        }

    };

    var baptis_data = {
        labels: bulans,
        datasets: [{
            label: "Grafik Baptis",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: baptis_requests,
        }]
    };

    var kaj_data = {
        labels: bulans,
        datasets: [{
            label: "Grafik Baptis",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: kaj_requests,
        }]
    };

    var kom_data = {
        labels: bulans,
        datasets: [{
            label: "Grafik Baptis",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: kom_requests,
        }]
    };

    var altar_data = {
        labels: bulans,
        datasets: [{
            label: "Grafik Baptis",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: altar_requests,
        }]
    };

    var baptisChart = Chart.Line(baptis_canvas, {
        data: baptis_data,
        options: option
    });

    var kajChart = Chart.Line(kaj_canvas, {
        data: kaj_data,
        options: option
    });

    var komChart = Chart.Line(kom_canvas, {
        data: kom_data,
        options: option
    });

    var altarChart = Chart.Line(altar_canvas, {
        data: altar_data,
        options: option
    });

    $(document).ready(function () {
        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('superadmin.statistic.jemaat.dt') }}",
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            },
            {
                render: function ( data, type, row ) {
                    if(data == 'N/A') {
                        data = '-';
                    }
                    return data;
                },
                targets: [2, 10],
            }
            ],
            order: [
                [0, 'asc']
            ],
            columns: [{
                    name: 'id',
                    defaultContent: '-',
                    orderable: false,
                },
                {
                    name: 'nama',
                    defaultContent: '-',
                },
                {
                    name: 'fa.FA_number',
                    defaultContent: '-',
                    orderable: false,
                },
                {
                    name: 'jenis_kelamin',
                    defaultContent: '-',
                },
                {
                    name: 'tempat_lahir',
                    defaultContent: '-',
                },
                {
                    name: 'tgl_lahir',
                    defaultContent: '-',
                },
                {
                    name: 'profesi',
                    defaultContent: '-',
                },
                {
                    name: 'status_pernikahan',
                    defaultContent: '-',
                },
                {
                    name: 'no_hp',
                    defaultContent: '-',
                },
                {
                    name: 'alamat',
                    defaultContent: '-',
                },
                {
                    name: 'cabangGereja.nama_gereja',
                    defaultContent: '-',
                },
                {
                    name: 'nama_ibu',
                    defaultContent: '-',
                },
                {
                    name: 'nama_ayah',
                    defaultContent: '-',
                },
                {
                    name: 'status',
                    defaultContent: '-',
                }
            ],
        });
    });
</script>
@endpush