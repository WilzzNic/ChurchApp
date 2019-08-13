@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row justify-content-xl-center">
        <div class="col-xl-7 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Jumlah Pengajuan KOM</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales"
                                    data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'
                                    data-prefix="$" data-suffix="k">
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
                        <canvas id="myChart" class="chart-canvas"></canvas>
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
                    <div class="row">
                        <div class="col">
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
        padding: !important .92857143em .78571429em;
        text-align: inherit;
    }
    .ui.grid {
        margin-top: -1rem;
        margin-bottom: -1rem;
        margin-left: 1rem;
        margin-right: -1rem;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            scrollX: true,
            responsive: {
                details: false
            },
            ajax: "{{ route('leader.statistic.jemaat.dt') }}",
            columnDefs: [
                {
                    render: function (data, type, row) {
                        if (data == 'N/A') {
                            data = '-';
                        }
                        return data;
                    },
                    targets: 2
                }
            ],
            order: [
                [0, 'asc']
            ],
            columns: [{
                    name: 'id',
                    defaultContent: '-',
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
                    orderable: false,
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

    var canvas = document.getElementById('myChart');
    var data_array = {{ json_encode($data, JSON_HEX_TAG) }};
    var data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ],
        datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: data_array,
        }]
    };
    var option = {
        legend: {
            display: false
        },
        tooltips: {
            enabled: false
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
            duration: 1000,
            onComplete: function() {
                var chartInstance = this.chart,
                ctx = chartInstance.ctx;

                ctx.font = Chart.helpers.fontString(this.fontSize, this.fontStyle, this.fontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
                ctx.fillStyle = 'lightgrey';

                this.data.datasets.forEach(function(dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function(bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                    });
                });
            }
        }

    };

    var myBarChart = Chart.Bar(canvas, {
        data: data,
        options: option
    });
</script>
@endpush