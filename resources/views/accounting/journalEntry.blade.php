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

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#journalEntryModal"><i class="fa-regular fa-pen-to-square"></i>
                        Add New Journal
                    </button>
                </div>
                <div class="card-body ">
                    <table id="journalTable" class="table table-responsive-sm table-hover">
                        <colgroup>
                            <col width="15%">
                            <col width="15%">
                            <col width="44%">
                            <col width="16%">
                            <col width="5%">
                        </colgroup>
                        <thead class="table-info border ">

                            <tr>
                                <th class="border text-center">Date</th>
                                <th class="border text-center">Journal Code</th>
                                <!-- <th>Partners</th> -->
                                <th class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2 border ">Description</div>
                                        <div class="col-3 px-2 border text-end">Debit</div>
                                        <div class="col-3 px-2 border text-end">Credit</div>
                                    </div>
                                </th>
                                <!-- <th>Journal</th> -->
                                <th class="border text-center">Added By</th>
                                <!-- <th>Status</th> -->
                                <th class="border text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class=" ">
                            @foreach ($journalEntry as $journalEntry)
                                <tr class="bg bg-secondary bg-opacity-10">
                                    <td class="text-center"><?= date('M d, Y', strtotime($journalEntry->entry_date)) ?></td>
                                    <td class="text-center">{{ $journalEntry->entry_code }}</td>
                                    <!-- <th>Partners</th> -->
                                    <td class="p-2">
                                        <div class="d-flex w-100 ">
                                            <div class="col-6 px-2 text-center"><b>{{ $journalEntry->description }}</b>
                                            </div>

                                            <div class="col-3 px-2 "></div>


                                            <div class="col-3 px-2 "></div>
                                        </div>
                                    </td>
                                    <!-- <th>Journal</th> -->
                                    <td class="text-center">{{ $journalEntry->user->name }}</td>
                                    <!-- <th>Status</th> -->
                                    <td class="text-center"><button class="btn btn-warning btn-sm edit btn-flat"
                                            data-id=""><i class="fa-solid fa-file-pen"></i></button>
                                        <button class="btn btn-danger btn-sm delete btn-flat" data-id=""><i
                                                class="fa-solid fa-trash"></i></i></button>
                                    </td>
                                </tr>

                                @foreach ($journalEntry->journal_item as $item)
                                    <tr class="s">
                                        <td></td>
                                        <td></td>
                                        <!-- <th>Partners</th> -->
                                        <td class="p-2">
                                            <div class="d-flex w-100 ">
                                                <div class="col-6 px-2">{{ $item->account_list->account_name }}</div>
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
                                                <div class="col-3 px-2 text-end"><?= $debit ?></div>
                                                <div class="col-3 px-2 text-end"><?= $credit ?></div>
                                            </div>
                                        </td>
                                        <!-- <th>Journal</th> -->
                                        <td></td>
                                        <!-- <th>Status</th> -->
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="border text-center">Date</th>
                                <th class="border text-center">Journal Code</th>
                                <th class="p-2">
                                    <div class="d-flex w-100 ">
                                        <div class="col-6 px-2 border ">Description</div>
                                        <div class="col-3 px-2 border text-end">Debit</div>
                                        <div class="col-3 px-2 border text-end">Credit</div>
                                    </div>
                                </th>
                                <th class="border text-center">Added By</th>
                                <th class="border text-center">Action</th>
                            </tr>
                        </tfoot>
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
        $(document).ready(function() {
            $('#journalTable').DataTable({
                orderCellsTop: {true,}
            });
        });
    </script>
    {{-- DATA TABLE --}}
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
