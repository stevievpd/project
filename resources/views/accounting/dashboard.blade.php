@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    <link rel="stylesheet" href="/css/accounting/style.dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                <div class="col">
                    {{-- Profit --}}
                    <?php
                    $totalrev = 0;
                    $totalOtherIncome = 0;
                    $totalincome = 0;
                    $revenuedebit = 0;
                    $debit = 0;
                    $credit = 0;
                    $rev = 0;
                    ?>
                    @foreach ($totalItems as $item)
                        @if ($item->group->description == 'Revenue')
                            @if ($item->type == 2)
                                <?php
                                $credit = $item->amount;
                                ?>
                            @endif
                            @if ($item->type == 1)
                                <?php
                                $debit = $item->amount;
                                ?>
                            @endif
                            <?php
                            $rev = $credit - $debit;
                            $totalrev = $totalrev + $rev;
                            ?>
                        @endif
                    @endforeach
                    <?php
                    $debit = 0;
                    $credit = 0;
                    ?>
                    @foreach ($totalItems as $item)
                        @if ($item->group->description == 'Income')
                            @if ($item->type == 2)
                                <?php
                                $credit = $credit + $item->amount;
                                ?>
                            @endif
                            @if ($item->type == 1)
                                <?php
                                $debit = $debit + $item->amount;
                                ?>
                            @endif
                        @endif
                        <?php
                        $totalincome = $debit - $credit;
                        ?>
                    @endforeach
                    <?php
                    $debit = 0;
                    $credit = 0;
                    ?>
                    @foreach ($totalItems as $item)
                        @if ($item->group->description == 'Other Income')
                            @if ($item->type == 2)
                                <?php
                                $credit = $credit + $item->amount;
                                ?>
                            @endif
                            @if ($item->type == 1)
                                <?php
                                $debit = $debit + $item->amount;
                                ?>
                            @endif
                        @endif
                        <?php
                        $totalOtherIncome = $debit - $credit;
                        ?>
                    @endforeach
                    <?php
                    $revenueTotal = 0;
                    $revenueTotal = $totalrev + $totalincome + $totalOtherIncome;
                    ?>
                    <?php
                    $totalExpense = 0;
                    $debit = 0;
                    $credit = 0;
                    ?>
                    @foreach ($groupItems as $item)
                        <?php
                        $expense = 0;
                        $totaldebit = 0;
                        $totalcredit = 0;
                        $debit = 0;
                        $credit = 0;
                        ?>
                        @if ($item->group->status == 5)
                            @foreach ($totalItems as $exp)
                                @if ($item->account_list->account_name == $exp->account_list->account_name)
                                    @if ($exp->type == 1)
                                        <?php
                                        $debit = $debit + $exp->amount;
                                        ?>
                                    @endif
                                    @if ($exp->type == 2)
                                        <?php
                                        $credit = $credit + $exp->amount;
                                        ?>
                                    @endif
                                @endif
                                <?php
                                $expense = $debit - $credit;
                                ?>
                            @endforeach
                        @endif
                        <?php
                        $totalExpense = $expense + $totalExpense;
                        ?>
                    @endforeach
                    <?php
                    $profit = $revenueTotal - $totalExpense;
                    ?>
                    {{-- profit end --}}
                    <span class="text">
                        <h3><?= $pasteProfit = '₱ ' . number_format($profit, 2) ?></h3>
                        <p>Net Income</p>
                    </span>
                </div>
            </li>

            <li>
                <i class='bx bx-book-content'></i></i>
                <span class="text">
                    <h3><?= $pasteProfit = '₱ ' . number_format($bankandcash, 2) ?></h3>
                    <p>Bank and Cash</p>
                </span>
            </li>
            <li>
                <i class='bx bx-user'></i>
                <span class="text">
                    <h3><?= $pasteProfit = '₱ ' . number_format($receivable, 2) ?></h3>
                    <p>Account Receivable</p>
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
            <div class="">
                <div style="width: 20%">
                    <form action="/accounting" id="dashboard" method="get">
                        @csrf
                        <select class="form-select shadow-sm p-3 mb-5 bg-body rounded asof"
                            aria-label="Default select example" name="option" onchange="this.form.submit()">
                            <option value="asofnow " {{ $filter == 'asofnow' ? 'selected' : '' }}>As of {{ $now }}
                            </option>
                            <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>This Month:
                                {{ $thisMonth }} </option>
                            <option value="last_month" {{ $filter == 'last_month' ? 'selected' : '' }}>Last Month:
                                {{ $lastMonth }}</option>
                            <option value="this_year" {{ $filter == 'this_year' ? 'selected' : '' }}>This Year:
                                {{ $thisYear }}</option>
                            <option value="last_year" {{ $filter == 'last_year' ? 'selected' : '' }}>Last Year:
                                {{ $lastYear }}</option>
                        </select>
                    </form>
                </div>
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
                        <div class="col-6 ">
                            <div class="text-center"><h3>Assets</h3></div>
                            <div class="border shadow p-3 mb-5 bg-body-tertiary rounded"id="currentasset"></div>
                        </div>
                        <div class="col-6 ">
                            <div class="text-center"><h3>Revenue</h3></div>
                            <div class="border shadow p-3 mb-5 bg-body-tertiary rounded" id="revenue"></div>
                        </div>
                        <div class="col-6 ">
                            <div class="text-center"><h3>Sample</h3></div>
                            <div class="border shadow p-3 mb-5 bg-body-tertiary rounded"id="currentasset"></div>
                        </div>
                        <div class="col-6 ">
                            <div class="text-center"><h3>Expenses</h3></div>
                            <div class="border shadow p-3 mb-5 bg-body-tertiary rounded"id="expenses"></div>
                        </div>
                    </div>
                </div>

                {{-- charts --}}
            </div>
        </div>
    </main>
    {{-- apexcharts --}}
    <script>
        // current asset
        var options = {
            
            series: [{
                name: 'Current Assets',
                data: [
                    @foreach ($assetvalue as $item)
                        {{ $item }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'area',
                height: 350,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                    borderRadius: 10,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                curve: 'smooth',
                lineCap: 'butt',
                colors: undefined,
                width: 2,
                dashArray: 0,
            },
            xaxis: {
                categories: [
                    @foreach ($assetmonth as $item)
                        '{{ $item }}',
                    @endforeach
                ],
            },
            yaxis: {
                title: {
                    text: ''
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "P " + val
                    }
                }
            },

        };
        var chart = new ApexCharts(document.querySelector("#currentasset"), options);
        chart.render();
        // current asset

        // Revenue
        var options = {
            colors : ['#5c9e4f', '#69d173'],
            series: [{
                name: 'Revenue',
                data: [
                    @foreach ($revenuevalue as $item)
                        {{ $item }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'bar',
                height: 350,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                    borderRadius: 10,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                curve: 'smooth',
                lineCap: 'butt',
                colors: undefined,
                width: 2,
                dashArray: 0,
            },
            xaxis: {
                categories: [
                    @foreach ($revenuemonth as $item)
                        '{{ $item }}',
                    @endforeach
                ],
            },
            yaxis: {
                title: {
                    text: ''
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "P " + val
                    }
                }
            },

        };
        var chart = new ApexCharts(document.querySelector("#revenue"), options);
        chart.render();
        // Revenue
        // Expenses
        var options = {
            colors : ['#b84644', '#4576b5'],
            series: [{
                name: 'Revenue',
                data: [
                    @foreach ($expensesvalue as $item)
                        {{ $item }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'bar',
                height: 350,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                    borderRadius: 10,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                curve: 'smooth',
                lineCap: 'butt',
                colors: undefined,
                width: 2,
                dashArray: 0,
            },
            xaxis: {
                categories: [
                    @foreach ($expensesmonth as $item)
                        '{{ $item }}',
                    @endforeach
                ],
            },
            yaxis: {
                title: {
                    text: ''
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "P " + val
                    }
                }
            },

        };
        var chart = new ApexCharts(document.querySelector("#expenses"), options);
        chart.render();
        // Revenue
    </script>
@endsection
