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
                    <div class="row mb-5">
                        <div class="column text-center">
                            <canvas id="assets" class="responsive-canvas"></canvas>
                            <span class="chartTitle">Assets</span>

                        </div>
                        <div class="column text-center">
                            <canvas id="revenue" class="responsive-canvas"></canvas>
                            <span class="chartTitle">Revenue</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column text-center">
                            <canvas id="bankAndCash" class="responsive-canvas"></canvas>
                            <span class="chartTitle">Bank and Cash</span>

                        </div>
                        <div class="column text-center">
                            <canvas id="expenses" class="responsive-canvas"></canvas>
                            <span class="chartTitle">Expenses</span>
                        </div>
                    </div>

                </div>

                {{-- charts --}}
            </div>
        </div>
    </main>
    <script>
        const asset = document.getElementById('assets');
        const revenue = document.getElementById('revenue');
        const bankcash = document.getElementById('bankAndCash');
        const expense = document.getElementById('expenses');
        new Chart(asset, {
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
        new Chart(bankcash, {
            type: 'bar',
            data: {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: ['Debit'],
                    data: [6543, 13219, 3356, 6545, 6462, 6543, 8569, 8541, 3649, 16547, 3695, 12354],
                    borderWidth: 1,
                    backgroundColor: 'rgba(238, 147, 7, 0.2)',
                    borderColor: 'rgb(238, 147, 7)',
                },
                {
                    label: ['Credit'],
                    data: [3543, 11219, 6356, 1545, 6262, 6943, 5569, 8541, 3149, 12547, 1695, 10354],
                    borderWidth: 1,
                    backgroundColor: 'rgba(128, 128, 128, 0.2)',
                    borderColor: 'rgb(128, 128, 128)',
                },
            ],
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
        new Chart(expense, {
            type: 'bar',
            data: {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: ['Expenses'],
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
        new Chart(revenue, {
            type: 'bar',
            data: {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: ['Revenue'],
                    data: [6543, 13219, 3356, 6545, 6462, 6543, 8569, 8541, 3649, 16547, 3695, 12354],
                    borderWidth: 1,
                    backgroundColor: 'rgb(119, 172, 119, 0.2)',
                    borderColor: 'rgb(119, 172, 119)',
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
