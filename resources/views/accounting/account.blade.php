@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    @include('layouts/modal.AccountingModals.AccountingModal')
    <link rel="stylesheet" href="/css/accounting/style.accounting.css">
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
                <span class="text">
                    <h3>{{ $accountCount }}</h3>
                    <p>Active Account List</p>
                </span>
            </li>
            <li>
                <i class='bx bx-book-content'></i></i>
                <span class="text">
                    <h3>{{ $groupCount }}</h3>
                    <p>Active Group List</p>
                </span>
            </li>
            <li>
                <i class='bx bx-user'></i>
                <span class="text">
                    <h3>{{ $bankCount }}</h3>
                    <p>Bank Accounts</p>
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
            <div class="card">
                <div class="card-body">
                    <ul class="navbar">
                        <li>
                            <a href="#account" class="tab active" data-id="home">
                                <span class="text">Account List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#group" class="tab" data-id="profile">
                                <span class="text">Group List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#partner" class="tab" data-id="messages">
                                <span class="text">Partners</span>
                            </a>
                        </li>
                        <li>
                            <a href="#bank" class="tab" data-id="settings">
                                <span class="text">Bank Account</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="order">
                                <div class="head">
                                    <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#newAccountListModal">
                                        <span>
                                            <i class='bx bxs-plus-circle'></i>
                                            Add New Account List
                                        </span>
                                    </button>
                                </div>

                                <table id="journalTable'">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Account Name</th>
                                            <th class="text-center">Account Type</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accountList as $acc)
                                            <?php
                                            $status = $acc->status;
                                            if ($status == 1) {
                                                $status = '<span class ="badge text-bg-success bg-opacity-25 percent" style="color: green !important">Active</span>';
                                            } elseif ($status == 2) {
                                                $status = '<span class ="badge text-bg-danger bg-opacity-25 percent" style="color: red !important">Inactive</span>';
                                            } else {
                                                $status = 'Undefined';
                                            }
                                            ?>
                                            <tr>

                                                <td class="text-center" >{{ $acc->code }}</td>
                                                <td class="text-center" >{{ $acc->account_name }}</td>
                                                <td class="text-center" >{{ $acc->group->group_name }}</td>
                                                <td class="text-center" >{{ $acc->description }}</td>
                                                <td class="text-center"><?= $status ?> </td>
                                                <td class="text-center">
                                                    <div id="wrapper">
                                                        <button class="dropdownBtnEdit btnEditAccount"
                                                            data-id="{{ $acc->id }}"><i
                                                                class="fa-solid fa-file-pen"></i></button>
                                                        <button class="dropdownBtn btnDeleteAccount"
                                                            data-del="{{ $acc->id }}"><i
                                                                class="fa-solid fa-trash"></i></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="order">
                                <div class="head">
                                    <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#newGroupListModal">
                                        <span>
                                            <i class='bx bxs-plus-circle'></i>
                                            Add Group List
                                        </span>
                                    </button>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center">Group Name</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupList as $grp)
                                            <?php
                                            $status = $grp->status;
                                            if ($status == 1) {
                                                $status = '<span class ="badge text-bg-success bg-opacity-25 percent" style="color: green !important">Active</span>';
                                            } elseif ($status == 2) {
                                                $status = '<span class ="badge text-bg-danger bg-opacity-25 percent" style="color: red !important">Inactive</span>';
                                            } else {
                                                $status = 'Undefined';
                                            }
                                            ?>
                                            <tr>

                                                <td class="text-center">{{ $grp->group_name }}</td>
                                                <td class="text-center">{{ $grp->description }}</td>
                                                <td class="text-center">

                                                    @if ($grp->type == 1)
                                                        Debit
                                                    @elseif($grp->type == 2)
                                                        Credit
                                                    @else
                                                        Undefined
                                                    @endif
                                                </td>
                                                <td class="text-center"><?= $status ?> </td>
                                                <td class="text-center">
                                                    <div id="wrapper">
                                                        <button class="dropdownBtnEdit btnEditGroup"
                                                            data-id="{{ $grp->id }}"><i
                                                                class="fa-solid fa-file-pen"></i></button>
                                                        <button class="dropdownBtn btnDeleteGroup"
                                                            data-del="{{ $grp->id }}"><i
                                                                class="fa-solid fa-trash"></i></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#newDepartment">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Bank Account
                                            </span>
                                        </button></h3>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#newBankAccount">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Bank Account
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">Bank</th>
                                            <th class="text-center">Account Number</th>
                                            <th class="text-center">Account Holder</th>
                                            <th class="text-center">Company</th>
                                            <th class="text-center">Contact Info</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bankAccount as $bank)
                                            <tr>
                                                <td><img
                                                        src="/img/bank_image/{{ $bank->bank_meta->bank_image }}"
                                                        style="height: 30px; width: 90px; border-radius:0%; object-fit:fill;"></td>
                                                <td class="text-center">{{ $bank->bank_meta->bank_name }}</td>
                                                <td class="text-center">{{ $bank->account_number }}</td>
                                                <td class="text-center">{{ $bank->account_holder }}</td>
                                                <td class="text-center">{{ $bank->company }}</td>
                                                <td class="text-center">{{ $bank->contact }}</td>
                                                <td class="text-center">
                                                    <div id="wrapper">
                                                        <button class="dropdownBtnEdit btnEditBank"
                                                            data-id="{{ $bank->id }}"><i
                                                                class="fa-solid fa-file-pen"></i></button>
                                                        <button class="dropdownBtn btnDeleteBank"
                                                            data-del="{{ $bank->id }}"><i
                                                                class="fa-solid fa-trash"></i></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- DATA TABLE --}}
    {{-- DATA TABLE --}}
    <script>
        $(document).ready(function() {
            $('#journalTable').DataTable({
                bSort: false,
                pageLength: 10,
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
                            columns: ':visible'
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
    {{-- DATA TABLE --}}

    {{-- TAB PANE SCRIPTS --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add active class on tab click
            $(".tab").on("click", function() {
                var categoryId = $(this).data("id");

                $(".tab, .tab-pane").removeClass("active");
                $(this).addClass("active");
                $("#" + categoryId).addClass("active");
            });

            // edit modal
            $(document).on('click', '.btnEditAccount', function() {
                var accId = $(this).attr("data-id");
                var url = "/editAccountList";
                $.get(url + '/' + accId, function(data) {
                    //success data
                    $('#accountId').val(data.id);
                    $('#accountName').val(data.account_name);
                    $('#description').val(data.description);
                    $("div.statusSelect select").val(data.status).change();
                    $('#editAccountListModal').modal('show');
                })
            });

            $(document).on('click', '.btnEditGroup', function() {
                var grpId = $(this).attr("data-id");
                var url = "/editGroupList";
                $.get(url + '/' + grpId, function(data) {
                    //success data
                    $('#groupId').val(data.id);
                    $('#groupName').val(data.group_name);
                    $('#descriptions').val(data.description);
                    $("div.statusSelect select").val(data.status).change();
                    $("div.typeSelect select").val(data.type).change();
                    $('#editGroupListModal').modal('show');
                })
            });
            $(document).on('click', '.btnEditBank', function() {
                var bankId = $(this).attr("data-id");
                var url = "/editBankAccount";
                $.get(url + '/' + bankId, function(data) {
                    //success data
                    $('#bankId').val(data.id);
                    $('#accountNumber').val(data.account_number);
                    $('#accountHolder').val(data.account_holder);
                    $('#email').val(data.email);
                    $('#address').val(data.address);
                    $('#company').val(data.company);
                    $('#contact').val(data.contact);
                    $('#zip').val(data.zip);
                    $("div.bankSelect select").val(data.bank_meta_id).change();
                    $("div.countrySelect select").val(data.country).change();
                    $('#editBankAccount').modal('show');
                })
            });

            // delete modal
            $('.btnDeleteAccount').on('click', function() {

                const accountId = $(this).attr("data-del");
                $('.deleteAccountId').val(accountId);
                $('#deleteAccountListModal').modal('show');
            });
            $('.btnDeleteGroup').on('click', function() {

                const groupId = $(this).attr("data-del");
                $('.deleteGroupId').val(groupId);
                $('#deleteGroupListModal').modal('show');
            });
            $('.btnDeleteBank').on('click', function() {

                const bankId = $(this).attr("data-del");
                $('.deleteBankId').val(bankId);
                $('#deleteBankModal').modal('show');
            });
        });
    </script>
@endsection
