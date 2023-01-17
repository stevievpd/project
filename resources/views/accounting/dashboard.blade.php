@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    <link rel="stylesheet" href="/css/accounting/style.dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Accounting</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Accounting</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Dashboard</a>
                    </li>
                </ul>
            </div>
            {{-- <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a> --}}
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bx-clipboard'></i>
                <span class="text">
                    <h3>₱ 1,655,102</h3>
                    <p>Net Income</p>
                </span>
            </li>
            <li>
                <i class='bx bx-book-content'></i></i>
                <span class="text">
                    <h3>₱ 2,644,350</h3>
                    <p>Account Receivable</p>
                </span>
            </li>
            <li>
                <i class='bx bx-user'></i>
                <span class="text">
                    <h3>₱ 342,553</h3>
                    <p>Account Payable</p>
                </span>
            </li>
        </ul>
        {{-- Employee Details --}}
        @if (Session::has('msg'))
            <script>
                $(document).ready(function() {
                    $("#popModalSuccess").modal('show');
                });
            </script>
            <p class="alert alert-info">{{ Session::get('msg') }}</p>
        @endif
        @if (Session::has('msgDel'))
            <script>
                $(document).ready(function() {
                    $("#deletePopupModal").modal('show');
                });
            </script>
            <p class="alert alert-danger">{{ Session::get('msgDel') }}</p>
        @endif
        {{-- session --}}
        <div class="table-data">
            <div class="card">
                <div class="card-body">
                    {{-- charts --}}
                    {{-- <div class="row gx-3">
                        <div class="col-6 shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="chart-container text-center">
                                <canvas id="myChart" class="responsive-canvas"></canvas>
                                <span class="chartTitle">Assets</span>
                            </div>
                        </div>
                        <div class="col-6 shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="chart-container text-center">
                                <canvas id="myChart2" class="responsive-canvas"></canvas>
                                <span class="chartTitle">Revenue</span>
                            </div>
                        </div>

                    </div> --}}
                    <div class="row">
                        <div class="column text-center">
                            <canvas id="myChart" class="responsive-canvas"></canvas>
                            <span class="chartTitle">Assets</span>

                        </div>
                        <div class="column text-center">
                            <canvas id="myChart2" class="responsive-canvas"></canvas>
                            <span class="chartTitle">Revenue</span>
                        </div>
                    </div>

                </div>

                {{-- charts --}}
            </div>
        </div>
    </main>
    <script>
        const ctx = document.getElementById('myChart');
        const ctxx = document.getElementById('myChart2');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: ['Total Assets'],
                    data: [6543, 13219, 3356, 6545, 6462, 6543, 8569, 8541, 3649, 16547, 3695, 12354],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        new Chart(ctxx, {
            type: 'bar',
            data: {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: ['Revenue'],
                    data: [6543, 13219, 3356, 6545, 6462, 6543, 8569, 8541, 3649, 16547, 3695, 12354],
                    borderWidth: 1,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                }],

            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endsection
