@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/humanresources/style.employee.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

@section('sidebar_content')
@section('content')
    @include('layouts.modals')
    @include('layouts/modal.AccountingModal')


    <div id="container cont-mains empMenu" class=" mx-4" id="main">
        <div id="content" class="" style="width: 80%; margin:auto;">

            <div class="row" style="width:99%; margin-left:auto; margin-right:auto;">
                <div class="row align-items-start shadow-sm pt-3 mb-4 bg-body rounded"
                    style="width:99%; margin-left:auto; margin-right:auto; ">
                    <div class="text-center titleHead  rounded">
                        <h1 class=" titleh1">Journal Entries</h1>
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
                        <div class="col-7"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#journalEntryModal"><i class="fa-regular fa-pen-to-square"></i>
                                Add New Journal
                            </button></div>
                        <div class="col-5">
                            <form action="/journal" id="journAdd" method="get">
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
                                                href="/journal"><i class="fa-solid fa-rotate-right">reset</i></a></button>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>


                </div>

                <div class="card-body ">
                    {{-- session --}}
                    @if ($dateStart && $dateEnd)
                        <p class="alert alert-success text-center"><b><?= date('F d, Y', strtotime($dateStart)) ?> to
                                <?= date('F d, Y', strtotime($dateEnd)) ?></b></p>
                    @endif


                    {{-- session --}}
                    <table id="journalTable" class="table table-responsive-sm table-hover">
                        <colgroup>
                            <col width="10%">
                            <col width="10%">
                            <col width="20%">
                            <col width="15%">
                            <col width="15%">
                            <col width="10%">
                            <col width="5%">
                        </colgroup>
                        <thead class="table-info  ">
                            <tr>
                                <th class="border-end">Date</th>
                                <th class="border-end text-center">Journal Code</th>
                                <th class="border-end">Description</th>
                                <th class="border-end text-end">Debit</th>
                                <th class="border-end text-end">Credit</th>
                                <th class="border-end text-center">Added By</th>
                                <th class="border-end">Action</th>

                            </tr>

                        </thead>
                        <tbody class="">
                            @foreach ($journalEntry as $journalEntry)
                                <tr class="bg-secondary bg-opacity-10">
                                    <td class="text-center" style="border-bottom:none;"><?= date('F d, Y', strtotime($journalEntry->entry_date)) ?></td>
                                    <td class="text-center" style="border-bottom:none;">{{ $journalEntry->entry_code }}</td>
                                    <td  style="border-bottom:none;"><b>{{ $journalEntry->title }}</b>&nbsp;
                                        <span style="font-size: 14px; font-style: oblique;">
                                            {{ $journalEntry->description ? $journalEntry->description : '' }}
                                        </span>
                                    </td>
                                    <td style="border-bottom:none;"></td>
                                    <td style="border-bottom:none;"></td>
                                    <td class="text-center" style="border-bottom:none;">{{ $journalEntry->user->name }}</td>
                                    <td class="text-center" style="border-bottom:none;">
                                        <div class="dropdown ">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle " type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-sliders"></i>
                                            </button>
                                            <ul class="dropdown-menu text-center border-0 bg-secondary bg-opacity-75">
                                                <button class="btn btn-warning btn-sm edit btn-flat" data-id=""><i
                                                        class="fa-solid fa-file-pen"></i></button>
                                                <button class="btn btn-danger btn-sm btnDeleteJourn btn-flat"
                                                    data-del="{{ $journalEntry->id }}"
                                                    data-code="{{ $journalEntry->entry_code }}"><i
                                                        class="fa-solid fa-trash"></i></i></button>
                                            </ul>
                                        </div>
                                    </td>
                                    @foreach ($journalEntry->journal_item as $item)
                                <tr>
                                    <td style="border-bottom:none;"></td>
                                    <td style="border-bottom:none;"></td>
                                    <td class="" >{{ $item->account_list->account_name }}</td>
                                    <?php
                                    $debit = '';
                                    $credit = '';
                                    if ($item->type == 1) {
                                        $debit = $item->amount;
                                        $debit = '₱ ' . number_format($debit, 2);
                                    } elseif ($item->type == 2) {
                                        $credit = $item->amount;
                                        $credit = '₱ ' . number_format($credit, 2);
                                    }
                                    ?>
                                    <td class="text-end"><?= $debit ?></td>
                                    <td class="text-end"><?= $credit ?></td>
                                    <td style="border-bottom:none;"></td>
                                    <td style="border-bottom:none;"></td>
                                </tr>
                            @endforeach
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

    {{-- DATA TABLE --}}
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        $(document).ready(function() {
            $('#journalTable').DataTable({
                bSort: false,
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            });
        });
    </script>
    {{-- DATA TABLE --}}
    {{-- DELETE JOURNAL ENTRY --}}
    <script>
        $(document).ready(function() {
            $('.btnDeleteJourn').on('click', function() {

                const journ_id = $(this).attr("data-del");
                const journ_code = $(this).attr("data-code");
                $('.journId').val(journ_id);
                $('.journCode').val(journ_code);
                $("#code").find("p").html(journ_code);
                $('#deleteJournalModal').modal('show');
            });
        });
    </script>
    {{-- DELETE JOURNAL ENTRY --}}
    <script>
        // JOURNAL ENTRY MODAL FUNCTIONS
        // calculate journal Debit and Credit
        function calcuAmount() {
            var debitAmount = 0;
            var creditAmount = 0;
            $('#tableJourn tbody tr').each(function() {
                if ($(this).find('.debitAmounts').text() != "") {
                    debitAmount += parseFloat(($(this).find('.debitAmounts').text()).replace(/,/gi, ''));
                }
                if ($(this).find('.creditAmounts').text() != "") {
                    creditAmount += parseFloat(($(this).find('.creditAmounts').text()).replace(/,/gi, ''));
                }
            })
            var totalamount = debitAmount - creditAmount;
            $('#tableJourn').find('.totalDebit').text(parseFloat(debitAmount).toLocaleString('en-US', {
                style: 'decimal'
            }))
            $('#tableJourn').find('.totalCredit').text(parseFloat(creditAmount).toLocaleString('en-US', {
                style: 'decimal'
            }))
            document.getElementById('totalcatch').value = totalamount;

            //for text color only
            if (totalamount >= 0) {
                $('#tableJourn').find('.totalBalanceJourn').text(parseFloat(totalamount).toLocaleString('en-US', {
                    style: 'decimal'
                }))
                document.getElementById("totalCol").style.color = "#196811"
            } else if (totalamount < 0) {
                $('#tableJourn').find('.totalBalanceJourn').text(parseFloat(totalamount).toLocaleString('en-US', {
                    style: 'decimal'
                }))
                document.getElementById("totalCol").style.color = "#9E1B18"
            }
        }

        $('#myButton').click(function() {
            var accountId = $('#accountListJourn').val()
            var groupId = $('#groupListJourn').val()
            var amountx = $('#amountJourn').val()
            var type = $('#typeId').val()
            if (groupId == '' || accountId == '' || amountx == '' || type == '') {
                $("#errorModalAccount").modal('show');
            } else {
                document.getElementById("accountListJourn").value = "";
                document.getElementById("groupListJourn").value = "";
                document.getElementById("amountJourn").value = "";
                document.getElementById("typeId").value = "";

                var rows = $($('noscript#cloneThis').html()).clone().appendTo("tbody#bodys")
                rows.find('input[name="account_ids[]"]').val(accountId) // add to input field
                rows.find('input[name="group_ids[]"]').val(groupId)
                rows.find('input[name="amounts[]"]').val(amountx)
                rows.find('input[name="amountType[]"]').val(type)

                @foreach ($accountList as $account)
                    if (accountId == {{ $account->id }}) {
                        rows.find('.accountsD').text('{{ $account->account_name }}') //Paste Account Name to table
                    }
                @endforeach

                @foreach ($groupList as $group)
                    if (groupId == {{ $group->id }}) {
                        rows.find('.groupsD').text('{{ $group->group_name }}') //Paste Group Name to table
                    }
                @endforeach


                if (type == '1') {
                    rows.find('.debitAmounts').text(parseFloat(amountx).toLocaleString('en-US', {
                        style: 'decimal'
                    }))
                }
                if (type == 2) {
                    rows.find('.creditAmounts').text(parseFloat(amountx).toLocaleString('en-US', {
                        style: 'decimal'
                    }))
                }
                if (type == '') {
                    alert("NEED AMOUNT TYPE")
                    rows.find('.creditAmounts').text("NO VALUE")
                    rows.find('.debitAmounts').text("NO VALUE")
                }
                calcuAmount()
                $('#tableJourn').append(tr)
            }
        })

        $('#tableJourn').on('click', ".delRow", function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            calcuAmount()
        });

        //catch 
        $('#journAdd').submit(function(e) {
            var total = document.getElementById('totalcatch').value;
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            if ($('#tableJourn tbody tr').length <= 0) {
                el.addClass('alert-danger').text(" Account Table is empty.")
                _this.prepend(el)
                el.show('slow')
                return false;
            }
            if (total != 0) {
                $("#errorModalTrial").modal('show');
                return false;
            }
        });
        //catch
        // JOURNAL ENTRY MODAL FUNCTIONS end
    </script>
@endsection
@endsection
