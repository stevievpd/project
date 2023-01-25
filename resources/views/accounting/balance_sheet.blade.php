@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    <link rel="stylesheet" href="/css/accounting/style.accounting.css">

    <main id="main-data">
        <div class="head-title">
            <div class="left">
                <h1>Balance Sheet</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Accounting</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active">Balance Sheet</a>
                    </li>
                </ul>
            </div>
            {{-- <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a> --}}
        </div>

        {{-- session --}}
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
                <div class="card-header" style="background-color: #ffff;">
                    <div class="row">
                        <div class="col-5">
                        </div>
                        <div class="col-7">
                            <form action="/balance-sheet" id="incomeState" method="get">
                                @csrf
                                <div class="row input-daterange">
                                    <div class="col-md-4">
                                        <input type="date" class="form-control dateStart" placeholder="Start"
                                            name="date_start"id="startdate" value="<?php
                                            $a_date = (new DateTime())->format('Y-m-d');
                                            $date = new DateTime($a_date);
                                            $date->modify('first day of this month');
                                            echo $date->format('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control dateEnd" placeholder="End" name="date_end"
                                            value="<?php
                                            $a_date = (new DateTime())->format('Y-m-d');
                                            $date = new DateTime($a_date);
                                            $date->modify('last day of this month');
                                            echo $date->format('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-4" id="wrapper">
                                        <button type="submit" name="filter" id="filter" class="journBtn"><i
                                                class="fa-solid fa-filter"></i>Filter</button>
                            </form>
                            <button type="button" name="refreshs" id="refreshs" class="journBtnInverse"><a
                                    href="/balance-sheet"><i class="fa-solid fa-rotate-right"></i>Reset</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body">

            <div class="order">

                <div class="" style="width: 50%; margin-left:auto; margin-right:auto;">
                    {{-- <h3>Balance Sheet</h3> --}}
                </div>
                <div class="income border">

                    <div class="text-center">
                        <h3>Balance Sheet</h3>
                        @if ($dateStart && $dateEnd)
                            <p class="text-center" style="color: rgb(92, 89, 89)">
                                <b><?= date('F d, Y', strtotime($dateStart)) ?> to
                                    <?= date('F d, Y', strtotime($dateEnd)) ?></b>
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="titlerev">
                            <h4>Assets</h4>
                        </div>
                        <div class="revenue row ">
                            {{-- Current asset --}}
                            <div class="col-12 border-bottom border-2"> <b>Current Asset</b> </div>
                            <?php
                            $totalCurrentAssets = 0;
                            ?>
                            @foreach ($groupItems as $item)
                                <?php
                                $currentAsset = 0;
                                $totaldebit = 0;
                                $totalcredit = 0;
                                $debit = 0;
                                $credit = 0;
                                ?>
                                @if ($item->group->description == 'Current Assets')
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
                                        $currentAsset = $debit - $credit;
                                        ?>
                                    @endforeach
                                    <div class="col-6">{{ $item->account_list->code }}
                                        {{ $item->account_list->account_name }}</div>
                                    <div class="col-6 botalign text-end">
                                        <?= $pasteAsset = '₱ ' . number_format($currentAsset, 2) ?>
                                    </div>
                                @endif
                                <?php
                                $totalCurrentAssets = $currentAsset + $totalCurrentAssets;
                                ?>
                            @endforeach
                            <div class="col-6 border-top" style="color:rgb(107, 104, 104)"> <b>Total Current Assets:</b>
                            </div>
                            <div class="col-6 border-top botalign text-end"> <b>
                                    <?= $pasteTotalAsset = '₱ ' . number_format($totalCurrentAssets, 2) ?></b></div>
                            {{-- Non-Current Assets --}}
                            <br>
                            <div class="col-12 border-bottom border-2 mt-1"> <b>Non Current Asset</b> </div>
                            <?php
                            $totalNonCurrentAssets = 0;
                            ?>
                            @foreach ($groupItems as $item)
                                <?php
                                $nonCurrentAsset = 0;
                                $totaldebit = 0;
                                $totalcredit = 0;
                                $debit = 0;
                                $credit = 0;
                                ?>
                                @if ($item->group->description == 'Non-Current Assets')
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
                                        $nonCurrentAsset = $debit - $credit;
                                        ?>
                                    @endforeach
                                    <div class="col-6">{{ $item->account_list->code }}
                                        {{ $item->account_list->account_name }}</div>
                                    <div class="col-6 botalign text-end">
                                        <?= $pasteNonCurAsset = '₱ ' . number_format($nonCurrentAsset, 2) ?></div>
                                @endif
                                <?php
                                $totalNonCurrentAssets = $nonCurrentAsset + $totalNonCurrentAssets;
                                ?>
                            @endforeach
                            <div class="col-6 border-top" style="color:rgb(107, 104, 104)"><b>Plus Total Non-Current
                                    Assets:</b></div>
                            <div class="col-6 border-top botalign text-end">
                                <b><?= $pasteTotalNonCurAsset = '₱ ' . number_format($totalNonCurrentAssets, 2) ?></b>
                            </div>
                            {{-- fixed Asset --}}
                            <br>
                            <div class="col-12 mt-1"> <b>Fixed Current Asset</b> </div>
                            <?php
                            $totalfixAssets = 0;
                            ?>
                            @foreach ($groupItems as $item)
                                <?php
                                $fixAsset = 0;
                                $totaldebit = 0;
                                $totalcredit = 0;
                                $debit = 0;
                                $credit = 0;
                                ?>
                                @if ($item->group->description == 'Fixed Assets')
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
                                        $fixAsset = $debit - $credit;
                                        ?>
                                    @endforeach
                                    <div class="col-6">{{ $item->account_list->code }}
                                        {{ $item->account_list->account_name }}</div>
                                    <div class="col-6 botalign text-end">
                                        <?= $pasteNonCurAsset = '₱ ' . number_format($nonCurrentAsset, 2) ?></div>
                                @endif
                                <?php
                                $totalfixAssets = $fixAsset + $totalfixAssets;
                                ?>
                            @endforeach
                            <div class="col-6 border-top" style="color:rgb(107, 104, 104)"> <b> Plus Total Fixed Assets:</b>
                            </div>
                            <div class="col-6 border-top botalign text-end">
                                <?= $pasteTotalFixAsset = '₱ ' . number_format($totalfixAssets, 2) ?></div>
                        </div>
                        <?php
                        $totalAsset = $totalCurrentAssets + $totalNonCurrentAssets + $totalfixAssets;
                        ?>
                        <div class="total row">
                            <div class="col-6 totalAsset">
                                <h5>Total Assets:</h5>
                            </div>
                            <div class="col-6 totalnum botalign text-end"> <b>
                                    <?= $pasteTotalasset = '₱ ' . number_format($totalAsset, 2) ?></b>
                            </div>
                        </div>
                    </div>
                    <br>
                    {{-- Liabilities --}}
                    <div class="row">
                        <div class="titlerev">
                            <h4>Liabilities</h4>
                        </div>
                        <div class="revenue row ">
                            {{-- Current Liabilities --}}
                            <div class="col-12"> <b>Current Liabilities</b> </div>
                            <?php
                            $totalCurrentLiab = 0;
                            ?>
                            @foreach ($groupItems as $item)
                                <?php
                                $currentLiab = 0;
                                $totaldebit = 0;
                                $totalcredit = 0;
                                $debit = 0;
                                $credit = 0;
                                ?>
                                @if ($item->group->description == 'Current Liabilities')
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
                                        $currentLiab = $credit - $debit;
                                        ?>
                                    @endforeach
                                    <div class="col-6">{{ $item->account_list->code }}
                                        {{ $item->account_list->account_name }}</div>
                                    <div class="col-6 botalign text-end">
                                        <?= $pastecurAsset = '₱ ' . number_format($currentLiab, 2) ?></div>
                                @endif
                                <?php
                                $totalCurrentLiab = $currentLiab + $totalCurrentLiab;
                                ?>
                            @endforeach
                            <div class="col-6" style="color:rgb(107, 104, 104)"> <b>Total Current Liabilities:</b> </div>
                            <div class="col-6 botalign text-end"> <b>
                                    <?= $pasteTotalLiab = '₱ ' . number_format($totalCurrentLiab, 2) ?></b></div>
                            {{-- Non-Current Liabilities --}}
                            <br>
                            <div class="col-12"> <b>Non Current Liabilities</b> </div>
                            <?php
                            $totalNonCurrentLiab = 0;
                            ?>
                            @foreach ($groupItems as $item)
                                <?php
                                $nonCurrentLiab = 0;
                                $totaldebit = 0;
                                $totalcredit = 0;
                                $debit = 0;
                                $credit = 0;
                                ?>
                                @if ($item->group->description == 'Non-current Liabilities')
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
                                        $nonCurrentLiab = $credit - $debit;
                                        ?>
                                    @endforeach
                                    <div class="col-6">{{ $item->account_list->code }}
                                        {{ $item->account_list->account_name }}</div>
                                    <div class="col-6 botalign text-end">
                                        <?= $pasteNonCurAsset = '₱ ' . number_format($nonCurrentAsset, 2) ?></div>
                                @endif
                                <?php
                                $totalNonCurrentLiab = $nonCurrentLiab + $totalNonCurrentLiab;
                                ?>
                            @endforeach
                            <div class="col-6" style="color:rgb(107, 104, 104)"> <b>Plus Total Non-Current Liabilities:</b>
                            </div>
                            <div class="col-6 botalign text-end">
                                <?= $pasteTotalNonCurLiab = '₱ ' . number_format($totalNonCurrentLiab, 2) ?></div>
                            <br>
                        </div>
                        <div class="total row">
                            <?php
                            $totalLiab = $totalCurrentLiab + $totalNonCurrentLiab;
                            ?>
                            <div class="col-6 totalAsset">
                                <h5>Total Liabilities:</h5>
                            </div>
                            <div class="col-6 totalnum botalign text-end"> <b>
                                    <?= $pasteTotalLiab = '₱ ' . number_format($totalLiab, 2) ?></b>
                            </div>
                        </div>
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

                    </div>
                    {{-- Equity --}}
                    <br>
                    <div class="row">
                        <div class="titlerev">
                            <h4>Equity</h4>
                        </div>
                        <div class="revenue row ">
                            {{-- Current Liabilities --}}
                            <div class="col-12"> <b>Owner's Equity</b> </div>
                            <?php
                            $totalEquity = 0;
                            ?>
                            @foreach ($groupItems as $item)
                                <?php
                                $equity = 0;
                                $totaldebit = 0;
                                $totalcredit = 0;
                                $debit = 0;
                                $credit = 0;
                                ?>
                                @if ($item->group->description == 'Equity')
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
                                        $equity = $credit - $debit;
                                        ?>
                                    @endforeach
                                    <div class="col-6">{{ $item->account_list->code }}
                                        {{ $item->account_list->account_name }}</div>
                                    <div class="col-6 botalign text-end">
                                        <?= $pasteEquity = '₱ ' . number_format($equity, 2) ?></div>
                                @endif
                                <?php
                                $totalEquity = $totalEquity + $equity;
                                ?>
                            @endforeach
                            <br>
                            {{-- Profit --}}
                            <?php
                            $totalrev = 0;
                            $totalOtherIncome = 0;
                            $totalincome = 0;
                            $revenuedebit = 0;
                            $debit = 0;
                            $credit = 0;
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
                                    $totalrev = $credit - $debit;
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

                            <?php
                            $totalLiab = $totalCurrentLiab + $totalNonCurrentLiab;
                            ?>
                            <div class="col-6">
                                Plus Profit:
                            </div>
                            <div class="col-6 totalnum botalign text-end"> <span><b>
                                        <?= $pasteProfit = '₱ ' . number_format($profit, 2) ?></b></span>
                            </div>

                            {{-- profit end --}}
                            <?php
                            $totalOwnerEquity = $profit + $totalEquity;
                            ?>
                            <div class="col-6"> <b>Total Owner's Equity:</b> </div>
                            <div class="col-6 botalign text-end"> <b>
                                    <?= $pasteTotalEquity = '₱ ' . number_format($totalOwnerEquity, 2) ?></b></div>
                        </div>
                        <div class="total row">
                            <?php
                            $balancesheet = $totalLiab + $totalOwnerEquity;
                            ?>
                            <div class="col-6 totalAsset">
                                <h5>Total Liabilities + Owner's Equity:</h5>
                            </div>
                            <div class="col-6 totalnum botalign text-end"> <b>
                                    <?= $pastebalance = '₱ ' . number_format($balancesheet, 2) ?></b>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $('.refreshs').click(function(event) {
            // Avoid the link click from loading a new page
            event.preventDefault();
            // Load the content from the link's href attribute
            $('.main-data').load($(this).attr('href'));
        });
    </script>
    {{-- DATA TABLE --}}
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        $(document).ready(function() {
            $('#journalTable').DataTable({
                bSort: false,
                pageLength: 20,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    // 'colvis'
                ]
            });
        });
    </script>
    {{-- DATA TABLE --}}
@endsection
