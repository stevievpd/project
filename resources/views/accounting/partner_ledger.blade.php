@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/humanresources/style.employee.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">



@section('sidebar_content')
@section('content')
    @include('layouts.modals')
    {{-- @include('layouts/modal.HumanResourcesModal') --}}


    <div id="container cont-mains empMenu" class=" mx-4" id="main">
        <div id="content" class="" style="width: 80%; margin:auto;">

            <div class="row" style="width:99%; margin-left:auto; margin-right:auto;">
                <div class="row align-items-start shadow-sm pt-3 mb-4 bg-body rounded"
                    style="width:99%; margin-left:auto; margin-right:auto; ">
                    <div class="text-center titleHead  rounded">
                        <h1 class=" titleh1">Partner Ledger</h1>
                    </div>
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

            </div>
            <!-- start of content -->
            <div class="card" style="width:98%; margin-left:auto; margin-right:auto;">

                <div class="card-header">
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="col-5">
                            <form action="/partner-ledger" id="journAdd" method="get">
                                @csrf
                                <div class="row input-daterange">
                                    <div class="col-md-4">
                                        <input type="date" class="form-control dateStart bg-success bg-opacity-10"
                                            placeholder="Start" name="date_start"id="startdate"
                                            value="<?php
                                            $a_date = (new DateTime())->format('Y-m-d');
                                            $date = new DateTime($a_date);
                                            $date->modify('first day of this month');
                                            echo $date->format('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control dateEnd bg-success bg-opacity-10"
                                            placeholder="End" name="date_end" value="<?php
                                            $a_date = (new DateTime())->format('Y-m-d');
                                            $date = new DateTime($a_date);
                                            $date->modify('last day of this month');
                                            echo $date->format('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-4">

                                        <button type="submit" name="filter" id="filter"
                                            class="btn btn-primary">Filter</button>
                                        <button type="button" name="refreshs" id="refreshs" class="btn btn-default"><a
                                                href="/partner-ledger">
                                                <box-icon name='reset' animation='spin' color='#6b1111'></box-icon>
                                            </a></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    @if ($dateStart && $dateEnd)
                        <p class="alert alert-success text-center"><b><?= date('F d, Y', strtotime($dateStart)) ?> to
                                <?= date('F d, Y', strtotime($dateEnd)) ?></b></p>
                    @endif
                    <table id="partnerTable" class="table table-responsive-sm table-hover">
                        <colgroup>
                            <col width="20%">

                            <col width="80%">
                        </colgroup>
                        <thead class="table-info">
                            <tr>
                                <th>Partner Name</th>
                                <th class="p-2">
                                    <div class="d-flex w-100">
                                        <div class="col-2  " style="text-align: center">Date</div>
                                        <div class="col-2  " style="text-align: center">Code</div>
                                        <div class="col-4  " style="text-align: center">Description</div>
                                        <div class="col-2   text-center">Debit</div>
                                        <div class="col-2   text-center">Credit</div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($partner as $partner)
                                <?php
                                $totaldeb = '';
                                $totalcred = '';
                                ?>
                                <tr>
                                    <td class="text-center"><b>{{ $partner->partner }}</b></td>

                                    <td>

                                        @foreach ($partneritem as $item)
                                            @foreach ($item->journal_item as $items)
                                                @if ($partner->partner == $item->partner)
                                                    <?php
                                                    if ($items->type == 1) {
                                                        $type1 = $items->amount;
                                                        $totaldeb = (float) $type1 + (float) $totaldeb;
                                                        $type1 = '₱ ' . number_format($type1, 2);
                                                    } else {
                                                        $type1 = '';
                                                    }
                                                    if ($items->type == 2) {
                                                        $type2 = $items->amount;
                                                        $totalcred = (float) $type2 + (float) $totalcred;
                                                        $type2 = '₱ ' . number_format($type2, 2);
                                                    } else {
                                                        $type2 = '';
                                                    }
                                                    ?>
                                                    <div class="d-flex w-100 fgh">
                                                        <div class="col-2 border-bottom text-center">
                                                            <span
                                                                class="pl-4"><?= date('M d, Y', strtotime($item->entry_date)) ?></span>
                                                        </div>
                                                        <div class="col-2 border-bottom text-center">
                                                            <span class="pl-4">{{ $item->entry_code }}</span>
                                                        </div>

                                                        <div class="col-4 border-bottom text-center">
                                                            <span class="pl-4">{{ $item->title }}</span>
                                                        </div>
                                                        <div class="col-2 px-2 border-bottom text-end">
                                                            <?= $type1 ?>
                                                        </div>
                                                        <div class="col-2 px-2 border-bottom text-end">
                                                            <?= $type2 ?>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                        <div class="d-flex w-100 fgh">
                                            <div class="col-2  text-center">

                                            </div>
                                            <div class="col-2  text-center">

                                            </div>

                                            <div class="col-4  text-center">

                                            </div>
                                            <div
                                                class="col-2 border-bottom text-end bg-success p-2 text-dark bg-opacity-10">
                                                <b><?php echo '₱ ' . number_format((float) $totaldeb, 2); ?></b>
                                            </div>
                                            <div class="col-2 border-bottom text-end bg-danger p-2 text-dark bg-opacity-10">
                                                <b><?php echo '₱ ' . number_format((float) $totalcred, 2); ?></b>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end of content -->
        </div>

    </div>
    {{-- ============================================================================================================================== --}}

    <style>
        body {
            background-color: #EAF6F6;
        }
    </style>
    {{-- scripts --}}
    <script>
        $(document).ready(function() {
            $('#partnerTable').DataTable();
        });
    </script>
@endsection
@endsection
