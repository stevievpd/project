@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    <link rel="stylesheet" href="/css/accounting/style.accounting.css">

    <main id="main-data">
        <div class="head-title">
            <div class="left">
                <h1>Trial Balance</h1>
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
            @if ($dateStart && $dateEnd)
                <p class="alert alert-success text-center"><b><?= date('F d, Y', strtotime($dateStart)) ?> to
                        <?= date('F d, Y', strtotime($dateEnd)) ?></b></p>
            @endif
            <div class="order">
                <table id="trialBalTable" class="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class=""></th>
                            <th class="text-center"></th>
                            <th class="">Balance</th>
                        </tr>
                        <tr>
                            <th scope="col">Account Name</th>
                            <th scope="col" class="text-end">Debit</th>
                            <th scope="col"class="text-end">Credit</th>
                            <th scope="col"class="text-end">Debit</th>
                            <th scope="col"class="text-end">Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalAccDeb = 0;
                        $totalAccCred = 0;
                        $totalBalDeb = 0;
                        $totalBalCre = 0;
                        ?>
                        @foreach ($journItems as $item)
                            <?php
                            $totaldeb = 0;
                            $totalcred = 0;
                            $totaldebPaste = 0;
                            $totalcredPaste = 0;
                            ?>
                            <tr>
                                <td scope="col">{{ $item->account_list->code }} {{ $item->account_list->account_name }}
                                </td>
                                @foreach ($totalItems as $totalJourn)
                                    <?php
                                    if ($item->account_list->account_name == $totalJourn->account_list->account_name) {
                                        if ($totalJourn->type == 1) {
                                            $debit = $totalJourn->amount;
                                            $totaldeb = $debit + $totaldeb;
                                            $totaldebPaste = $totaldeb;
                                        } elseif ($totalJourn->type == 2) {
                                            $credit = $totalJourn->amount;
                                            $totalcred = $credit + $totalcred;
                                            $totalcredPaste = $totalcred;
                                        }
                                    }
                                    ?>
                                @endforeach
                                <?php
                                if ($totaldebPaste == 0) {
                                    $totaldebPaste = '';
                                } else {
                                    $totaldebPaste = '₱ ' . number_format($totaldebPaste, 2);
                                }
                                if ($totalcredPaste == 0) {
                                    $totalcredPaste = '';
                                } else {
                                    $totalcredPaste = '₱ ' . number_format($totalcredPaste, 2);
                                }
                                ?>
                                <td scope="col" class="text-end">
                                    <?= $totaldebPaste ?></td>
                                <td scope="col"class="text-end">
                                    <?= $totalcredPaste ?></td>
                                <?php
                                // total account debit and credit
                                $totalAccDeb = $totaldeb + $totalAccDeb;
                                $totalAccCred = $totaldeb + $totalAccCred;
                                // total account debit and credit
                                if ($totaldeb > $totalcred) {
                                    $totaldeb = $totaldeb - $totalcred;
                                    $totaldebPaste = '₱ ' . number_format($totaldeb, 2);
                                    $totalcredPaste = '';
                                
                                    $totalBalDeb = $totaldeb + $totalBalDeb;
                                } elseif ($totaldeb < $totalcred) {
                                    $totalcred = $totalcred - $totaldeb;
                                    $totalcredPaste = '₱ ' . number_format($totalcred, 2);
                                    $totaldebPaste = '';
                                    $totalBalCre = $totalBalCre + $totalcred;
                                } elseif ($totaldeb = $totalcred) {
                                    $totaldebPaste = '';
                                    $totalcredPaste = '';
                                }
                                ?>
                                <td scope="col"class="text-end"><?= $totaldebPaste ?></td>
                                <td scope="col"class="text-end"><?= $totalcredPaste ?></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td scope="col"> <b>Total</b> </td>
                            <td scope="col" class="text-end">
                                <b><?= $totalAccDeb = '₱ ' . number_format($totalAccDeb, 2) ?></b>
                            </td>
                            <td scope="col"class="text-end">
                                <b><?= $totalAccCred = '₱ ' . number_format($totalAccCred, 2) ?></b>
                            </td>
                            <td scope="col"class="text-end">
                                <b><?= $totalBalDeb = '₱ ' . number_format($totalBalDeb, 2) ?></b>
                            </td>
                            <td scope="col"class="text-end">
                                <b><?= $totalBalCre = '₱ ' . number_format($totalBalCre, 2) ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            $('#trialBalTable').DataTable({
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
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];

                            $('row c[r^="B"]', sheet).attr('s', '52');
                            $('row c[r^="C"]', sheet).attr('s', '52');
                            $('row c[r^="D"]', sheet).attr('s', '52');
                            $('row c[r^="E"]', sheet).attr('s', '52');
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'pdfHtml5',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    // 'colvis'
                ]
            });
        });
    </script>
    {{-- DATA TABLE --}}
@endsection
