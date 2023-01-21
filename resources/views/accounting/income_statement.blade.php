@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    <link rel="stylesheet" href="/css/accounting/style.accounting.css">

    <main id="main-data">
        <div class="head-title">
            <div class="left">
                <h1>Income Statement</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Accounting</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Journal</a>
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
                            <form action="/trial-balance" id="journAdd" method="get">
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
                                    href="/trial-balance"><i class="fa-solid fa-rotate-right"></i>Reset</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body">

            <div class="order">
                {{-- <div class="" style="width: 50%; margin-left:auto; margin-right:auto;">
                    <h3>INCOME STATEMENT</h3>
                </div> --}}
                <div class="income border">
                    <div class="row">
                        <div class="titlerev">
                            <h4>Revenue</h4>
                        </div>
                        <div class="revenue row ">
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
                                    $totalrev = $credit-$debit;
                                    ?>
                                @endif
                            @endforeach
                            <div class="col-6">Total Revenue:</div>
                            <div class="col-6 text-end"><?= $totalrev ?></div>

                            @foreach ($totalItems as $item)
                                @if ($item->group->description == 'Income')
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
                                    $totalincome = $debit - $credit;
                                    ?>
                                @endif
                            @endforeach
                            <div class="col-6">Income:</div>
                            <div class="col-6 text-end"><?= $totalincome ?></div>
                            @foreach ($totalItems as $item)
                                @if ($item->group->description == 'Other Income')
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
                                    $totalOtherIncome = $debit - $credit;
                                    ?>
                                @endif
                            @endforeach
                            <div class="col-6">Other Income:</div>
                            <div class="col-6 text-end"><?= $totalOtherIncome ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="titlerev">
                            <h4>Less: Expenses</h4>
                        </div>
                        <div class="revenue row ">
                            <?php
                            $totalExpense = 0;
                            $debit = 0;
                            $credit = 0;
                            ?>
                            @foreach ($totalItems as $item)
                                @if ($item->group->status == 5)
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
                                    $totalExpense = $debit-$credit;
                                    ?>
                                @endif
                            
                            <div class="col-6">Total Revenue:</div>
                            <div class="col-6 text-end"><?= $totalExpense ?></div>
                            @endforeach
                        </div>
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
