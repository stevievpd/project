@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    @include('layouts/modal/accountingModals.JournalModal')
    <link rel="stylesheet" href="/css/accounting/style.accounting.css">

    <main id="main-data">
        <div class="head-title">
            <div class="left">
                <h1>Accounting</h1>
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
                            <button type="button" class="journBtn " data-bs-toggle="modal"
                                data-bs-target="#journalEntryModal"><i class="fa-regular fa-pen-to-square"></i>
                                Add New Journal
                            </button>
                        </div>
                        <div class="col-7">
                            <form action="/journal" id="journAdd" method="get">
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
                                    href="/journal"><i class="fa-solid fa-rotate-right"></i>Reset</a></button>
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
                <table id="journalTable" class="table">
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="5%">
                    </colgroup>
                    <thead class="table">
                        <tr>
                            <th>Date</th>
                            <th>Journal Code</th>
                            <th>Transaction Title</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                            <th class="text-center">Added By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($journalEntry as $journalEntry)
                            <tr class="bg-secondary bg-opacity-10">
                                <td class="" style="border-bottom:none;">
                                    <?= date('F d, Y', strtotime($journalEntry->entry_date)) ?></td>
                                <td class="" style="border-bottom:none;">
                                    {{ $journalEntry->entry_code }}</td>
                                <td style="border-bottom:none;"><b>{{ $journalEntry->title }}</b> | {{ $journalEntry->description ? $journalEntry->description : '' }}
                                </td>
                                <td style="border-bottom:none;"></td>
                                <td style="border-bottom:none;"></td>
                                <td class="text-center" style="border-bottom:none;">
                                    {{ $journalEntry->user->name }}</td>
                                <td class="text-center" style="border-bottom:none;">
                                    <div class="dropdown ">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle " type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-gears"></i>
                                        </button>
                                        <ul class="dropdown-menu text-center border-0 bg-secondary bg-opacity-75">
                                            <div id="wrapper">
                                                <button class="dropdownBtnEdit btnEditJournal"
                                                    data-id="{{ $journalEntry->id }}"><i
                                                        class="fa-solid fa-file-pen"></i></button>
                                                <button class="dropdownBtn btnDeleteJourn"
                                                    data-del="{{ $journalEntry->id }}"
                                                    data-code="{{ $journalEntry->entry_code }}"><i
                                                        class="fa-solid fa-trash"></i></i></button>
                                            </div>
                                        </ul>
                                    </div>
                                </td>
                                @foreach ($journalEntry->journal_item as $item)
                            <tr>
                                <td style="border-bottom:none;"></td>
                                <td style="border-bottom:none;"></td>
                                <td class="">{{ $item->account_list->code }} {{ $item->account_list->account_name }}
                                </td>
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

    <script>
        // edit and delete journal
        $('#editJournalEntryModal').on('hidden.bs.modal', function() {
            $("tbody#bodysEdit tr").remove()
        })
        $(document).ready(function() {

            $('.btnDeleteJourn').on('click', function() {

                const journ_id = $(this).attr("data-del");
                const journ_code = $(this).attr("data-code");
                $('.journId').val(journ_id);
                $('.journCode').val(journ_code);
                $("#code").find("p").html(journ_code);
                $('#deleteJournalModal').modal('show');
            });

            //edit journal
            $(document).on('click', '.btnEditJournal', function() {
                var journId = $(this).attr("data-id");
                var url = "/editJournal";
                $.get(url + '/' + journId, function(data) {
                    //success data
                    $('#journIdEdit').val(data.journ.id);
                    $('#entryCodeEdit').val(data.journ.entry_code);
                    $('#entryDateEdit').val(data.journ.entry_date);
                    $('#titleEdit').val(data.journ.title);
                    $('#descriptEdit').val(data.journ.description);
                    $('#partnerEdit').val(data.journ.partner);

                    var entry = data.journ.entry_code;


                    @foreach ($journal_item as $items)
                        var code = '{{ $items->journ_code }}';
                        if (code == entry) {
                            var accountId = {{ $items->account_id }};
                            var groupId = {{ $items->group_id }};
                            var amountx = {{ $items->amount }};
                            var type = {{ $items->type }};

                            // append to row edit modal journal items
                            if (groupId == '' || accountId == '' || amountx == '' || type ==
                                '') {
                                $("#errorModalAccount").modal('show');
                            } else {

                                var rows = $($('noscript#cloneThisEdit').html()).clone()
                                    .appendTo("tbody#bodysEdit")
                                rows.find('input[name="account_idsEdit[]"]').val(
                                    accountId); // add to input field
                                rows.find('input[name="group_idsEdit[]"]').val(groupId);
                                rows.find('input[name="amountsEdit[]"]').val(amountx);
                                rows.find('input[name="amountTypeEdit[]"]').val(type);

                                @foreach ($accountList as $account)
                                    if (accountId == {{ $account->id }}) {
                                        rows.find('.accountsDEdit').text(
                                            '{{ $account->code }} {{ $account->account_name }}'
                                        ); //Paste Account Name to table
                                        rows.find('.groupsDEdit').text(
                                            '{{ $account->group->group_name }}'
                                        ); //Paste Group Name to table
                                    };
                                @endforeach

                                // @foreach ($groupList as $group)
                                //     if (groupId == {{ $group->id }}) {
                                //         rows.find('.groupsDEdit').text(
                                //             '{{ $group->group_name }}'
                                //         ); //Paste Group Name to table
                                //     };
                                // @endforeach


                                if (type == 1) {
                                    rows.find('.debitAmountsEdit').text(parseFloat(amountx)
                                        .toLocaleString('en-US', {
                                            style: 'decimal'
                                        }));
                                }
                                if (type == 2) {
                                    rows.find('.creditAmountsEdit').text(parseFloat(amountx)
                                        .toLocaleString('en-US', {
                                            style: 'decimal'
                                        }));
                                }
                                if (type == '') {
                                    alert("NEED AMOUNT TYPE")
                                    rows.find('.debitAmountsEdit').text("NO VALUE");
                                    rows.find('.debitAmountsEdit').text("NO VALUE");
                                }
                                // append to row edit modal journal items

                                // caculate total
                                var debitAmount = 0;
                                var creditAmount = 0;
                                $('#tableJournEdit tbody tr').each(function() {
                                    if ($(this).find('.debitAmountsEdit').text() !=
                                        "") {
                                        debitAmount += parseFloat(($(this).find(
                                                '.debitAmountsEdit').text())
                                            .replace(
                                                /,/gi, ''));
                                    }
                                    if ($(this).find('.creditAmountsEdit').text() !=
                                        "") {
                                        creditAmount += parseFloat(($(this).find(
                                                '.creditAmountsEdit').text())
                                            .replace(
                                                /,/gi, ''));
                                    }
                                })
                                var totalamount = debitAmount - creditAmount;
                                $('#tableJournEdit').find('.totalDebitEdit').text(parseFloat(
                                    debitAmount).toLocaleString('en-US', {
                                    style: 'decimal'
                                }))
                                $('#tableJournEdit').find('.totalCreditEdit').text(parseFloat(
                                    creditAmount).toLocaleString('en-US', {
                                    style: 'decimal'
                                }))
                                document.getElementById('totalcatchEdit').value = totalamount;

                                //for text color only
                                if (totalamount >= 0) {
                                    $('#tableJournEdit').find('.totalBalanceJournEdit').text(
                                        parseFloat(
                                            totalamount).toLocaleString('en-US', {
                                            style: 'decimal'
                                        }))
                                    document.getElementById("totalColEdit").style.color =
                                        "#196811"
                                } else if (totalamount < 0) {
                                    $('#tableJournEdit').find('.totalBalanceJournEdit').text(
                                        parseFloat(
                                            totalamount).toLocaleString('en-US', {
                                            style: 'decimal'
                                        }))
                                    document.getElementById("totalColEdit").style.color =
                                        "#9E1B18"
                                }
                                // caculate total
                            }
                        }
                    @endforeach
                    $('#editJournalEntryModal').modal('show');
                })
            });
        });
    </script>

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
            var spliter = $('#accountListJourn').val().split('|'),
                a = spliter[0],
                b = spliter[1];
            var acc = Number(a)
            var grp = Number(b)
            var accountId = acc;
            var groupId = grp;
            var amountx = $('#amountJourn').val()
            var type = $('#typeId').val()


            if (groupId == '' || accountId == '' || amountx == '' || type == '') {
                $("#errorModalAccount").modal('show');
            } else {
                document.getElementById("accountListJourn").value = "";
                document.getElementById("amountJourn").value = "";
                document.getElementById("typeId").value = "";

                var rows = $($('noscript#cloneThis').html()).clone().appendTo("tbody#bodys")
                rows.find('input[name="account_ids[]"]').val(accountId) // add to input field
                rows.find('input[name="group_ids[]"]').val(groupId)
                rows.find('input[name="amounts[]"]').val(amountx)
                rows.find('input[name="amountType[]"]').val(type)

                @foreach ($accountList as $account)
                    if (accountId == {{ $account->id }}) {
                        rows.find('.accountsD').text(
                            '{{ $account->code }} {{ $account->account_name }}') //Paste Account Name to table
                        rows.find('.groupsD').text('{{ $account->group->group_name }}') //Paste Group Name to table
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

        // for edit journal
        $('#tableJournEdit').on('click', ".delRowEdit", function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            editcalcuAmount()
        });
        // for edit journal

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
        $('#journEdit').submit(function(e) {
            var total = document.getElementById('totalcatchEdit').value;
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            if ($('#tableJournEdit tbody tr').length <= 0) {
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

        // =================for edit modal script====================//
        //calculate amount
        function editcalcuAmount() {
            var debitAmount = 0;
            var creditAmount = 0;
            $('#tableJournEdit tbody tr').each(function() {
                if ($(this).find('.debitAmountsEdit').text() !=
                    "") {
                    debitAmount += parseFloat(($(this).find(
                            '.debitAmountsEdit').text())
                        .replace(
                            /,/gi, ''));
                }
                if ($(this).find('.creditAmountsEdit').text() !=
                    "") {
                    creditAmount += parseFloat(($(this).find(
                            '.creditAmountsEdit').text())
                        .replace(
                            /,/gi, ''));
                }
            })
            var totalamount = debitAmount - creditAmount;
            $('#tableJournEdit').find('.totalDebitEdit').text(parseFloat(
                debitAmount).toLocaleString('en-US', {
                style: 'decimal'
            }))
            $('#tableJournEdit').find('.totalCreditEdit').text(parseFloat(
                creditAmount).toLocaleString('en-US', {
                style: 'decimal'
            }))
            document.getElementById('totalcatchEdit').value = totalamount;

            //for text color only
            if (totalamount >= 0) {
                $('#tableJournEdit').find('.totalBalanceJournEdit').text(
                    parseFloat(
                        totalamount).toLocaleString('en-US', {
                        style: 'decimal'
                    }))
                document.getElementById("totalColEdit").style.color =
                    "#196811"
            } else if (totalamount < 0) {
                $('#tableJournEdit').find('.totalBalanceJournEdit').text(
                    parseFloat(
                        totalamount).toLocaleString('en-US', {
                        style: 'decimal'
                    }))
                document.getElementById("totalColEdit").style.color =
                    "#9E1B18"
            }
        }
        $('#myButtonEdit').click(function() {
            var spliter = $('#accountListJournEdit').val().split('|'),
                a = spliter[0],
                b = spliter[1];
            var acc = Number(a)
            var grp = Number(b)
            var accountId = acc;
            var groupId = grp;
            var amountx = $('#amountJournEdit').val()
            var type = $('#typeIdEdit').val()

            // var accountId = $('#accountListJournEdit').val()
            // var groupId = $('#groupListJournEdit').val()
            // var amountx = $('#amountJournEdit').val()
            // var type = $('#typeIdEdit').val()
            if (groupId == '' || accountId == '' || amountx == '' || type ==
                '') {
                $("#errorModalAccount").modal('show');
            } else {
                document.getElementById("accountListJournEdit").value = "";
                // document.getElementById("groupListJournEdit").value = "";
                document.getElementById("amountJournEdit").value = "";
                document.getElementById("typeIdEdit").value = "";

                var rows = $($('noscript#cloneThisEdit').html()).clone()
                    .appendTo("tbody#bodysEdit")
                rows.find('input[name="account_idsEdit[]"]').val(
                    accountId); // add to input field
                rows.find('input[name="group_idsEdit[]"]').val(groupId);
                rows.find('input[name="amountsEdit[]"]').val(amountx);
                rows.find('input[name="amountTypeEdit[]"]').val(type);

                @foreach ($accountList as $account)
                    if (accountId == {{ $account->id }}) {
                        rows.find('.accountsDEdit').text(
                            '{{ $account->account_name }}'
                        ); //Paste Account Name to table
                        rows.find('.groupsDEdit').text(
                            '{{ $account->group->group_name }}'
                        ); //Paste Group Name to table
                    };
                @endforeach

                // @foreach ($groupList as $group)
                //     if (groupId == {{ $group->id }}) {
                //         rows.find('.groupsDEdit').text(
                //             '{{ $group->group_name }}'
                //         ); //Paste Group Name to table
                //     };
                // @endforeach


                if (type == 1) {
                    rows.find('.debitAmountsEdit').text(parseFloat(amountx)
                        .toLocaleString('en-US', {
                            style: 'decimal'
                        }));
                }
                if (type == 2) {
                    rows.find('.creditAmountsEdit').text(parseFloat(amountx)
                        .toLocaleString('en-US', {
                            style: 'decimal'
                        }));
                }
                if (type == '') {
                    alert("NEED AMOUNT TYPE")
                    rows.find('.debitAmountsEdit').text("NO VALUE");
                    rows.find('.debitAmountsEdit').text("NO VALUE");
                }
                editcalcuAmount();
                $('#tableJournEdit').append(tr);
            }
        })
        // =================for edit modal script====================//
    </script>
@endsection
