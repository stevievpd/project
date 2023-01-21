@extends('layouts.app')
@section('content')
    @include('layouts.modals')
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
                        <a class="active" href="#">Trial Balance</a>
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
                            {{-- filter form, get the code from journal entry --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <div class="card-body">
            {{-- filter form, get the code from journal entry --}}
            <div class="order">
                <table id="journalTable" class="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="">Date</th>
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
                        @foreach ($journItems as $item)
                            <tr>
                                <td scope="col">{{ $item->account_list->account_name }}</td>
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
                                <td scope="col" class="text-end"><?= $debit ?></td>
                                <td scope="col"class="text-end"><?= $credit ?></td>
                                <td scope="col"class="text-end">Debit bal</td>
                                <td scope="col"class="text-end">Credit bal</td>
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
@endsection
