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
                        <h1 class=" titleh1">General Ledger</h1>
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
                </div>
                <div class="card-body ">
                    <table id="generalTable" class="table table-responsive-sm table-hover">
                        <colgroup>
                            <col width="15%">
                            <col width="85%">
                        </colgroup>
                        <thead class="table-info">
                            <tr>
                                <th style="text-align:center;">Account Name</th>
                                <th class="p-2">
                                    <div class="d-flex w-100">
                                        <div class="col-1 border" style="text-align: center">Date</div>
                                        <div class="col-2 border" style="text-align: center">Code</div>
                                        <div class="col-3 border" style="text-align: center">Description</div>
                                        <div class="col-2 border" style="text-align: center">Debit</div>
                                        <div class="col-2 border" style="text-align: center">Credit</div>
                                        <div class="col-2 border" style="text-align: center">Balance</div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ledger as $account)
                                <?php
                                $totaldeb = '';
                                $totalcred = '';
                                ?>
                                <tr>
                                    <td class="text-center"><b>{{ $account->account_list->account_name }}</b></td>

                                    <td>
                                        <div class="d-flex w-100 asd">
                                            <div class="col-1 "></div>
                                            <div class="col-2 "></div>
                                            <div class="col-3 "></div>
                                            <div class="col-2 "></div>
                                            <div class="col-2 "></div>
                                            <div class="col-2 "></div>
                                        </div>
                                        @foreach ($ledgeritems as $item)
                                            @if ($account->account_list->id == $item->account_list->id)
                                                <?php
                                                if ($item->type == 1) {
                                                    $type1 = $item->amount;
                                                    $totaldeb = (float) $type1 + (float) $totaldeb;
                                                    $type1 = '₱ ' . number_format($type1, 2);
                                                } else {
                                                    $type1 = '';
                                                }
                                                if ($item->type == 2) {
                                                    $type2 = $item->amount;
                                                    $totalcred = (float) $type2 + (float) $totalcred;
                                                    $type2 = '₱ ' . number_format($type2, 2);
                                                } else {
                                                    $type2 = '';
                                                }
                                                ?>
                                                <div class="d-flex w-100 fgh">
                                                    <div class="col-1  text-center">
                                                        <span
                                                            class="pl-4"><?= date('M d, Y', strtotime($item->entry->entry_date)) ?></span>
                                                    </div>
                                                    <div class="col-2  text-center">
                                                        {{ $item->entry->entry_code }}
                                                    </div>
                                                    <div class="col-3  text-center">
                                                        {{ $item->entry->description }}
                                                    </div>
                                                    <div class="col-2 px-2  text-end">
                                                        <?= $type1 ?>
                                                    </div>
                                                    <div class="col-2 px-2  text-end">
                                                        <?= $type2 ?>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach



                                        <div class="d-flex w-100 fgh">
                                            <div class="col-1 border-top text-center">

                                            </div>
                                            <div class="col-2 border-top text-center">

                                            </div>

                                            <div class="col-3 border-top text-center">

                                            </div>
                                            <div class="col-2 border-top text-end bg-info p-2 text-dark bg-opacity-10">
                                                <?php echo '₱ ' . number_format((float) $totaldeb, 2); ?>
                                            </div>
                                            <div class="col-2 border-top text-end bg-danger p-2 text-dark bg-opacity-10">
                                                <?php echo '₱ ' . number_format((float) $totalcred, 2); ?>
                                            </div>
                                            <div
                                                class="col-2 py-2 border-top text-end bg-secondary p-2 text-dark bg-opacity-10">
                                                <?php
                                                
                                                $floatvar = (float) $totalcred - (float) $totaldeb;
                                                
                                                if ((float) $totaldeb > (float) $totalcred) {
                                                    $floatvar = (float) $totaldeb - (float) $totalcred;
                                                
                                                    echo '<b><span style="color:#00802b; ">₱ ' . number_format((float) $floatvar, 2) . '</span><b>';
                                                }
                                                if ((float) $totaldeb < (float) $totalcred) {
                                                    $floatvar = (float) $totalcred - (float) $totaldeb;
                                                    echo '<b><span style="color:#b30000;">₱ ' . number_format((float) $floatvar, 2) . '</span><b>';
                                                }
                                                if ((float) $totaldeb == (float) $totalcred) {
                                                    $floatvar = (float) $totaldeb - (float) $totalcred;
                                                    echo '<b><span>₱ ' . number_format((float) $floatvar, 2) . '</span><b>';
                                                }
                                                ?>
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
            $('#generalTable').DataTable();
        });
    </script>
@endsection
@endsection
