@extends('layouts.app')

@section('content')
    @include('layouts.modals')
    @include('layouts/modal.PayrollModal')

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Payroll</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Attendance</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-coin-stack'></i>
                <span class="text">
                    <h3>1</h3>
                    <p>Total Salary</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-coin-stack'></i>
                <span class="text">
                    <h3>1</h3>
                    <p>Total Cash Advance</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-coin-stack'></i>
                <span class="text">
                    <h3>1</h3>
                    <p>Total Deductions</p>
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
                            <a href="#" class="tab active" data-id="home">
                                <span class="text">Attendance List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="profile">
                                <span class="text">Deduction List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="messages">
                                <span class="text">Cash Advance List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="settings">
                                <span class="text">Payroll List</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newEmployee">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add new attendance
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table id="employeelist" class="table">
                                    <thead>
                                        <tr class="">
                                            <th>Date</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $att)
                                        <tr>
                                            <td>{{ $att->date }}</td>
                                            <td>{{ $att->employee->employee_code }}</td>
                                            <td>{{ $att->employee->first_name }}{{ $att->employee->last_name }}</td>
                                            <td>{{ $att->time_in }}</td>
                                            <td>{{ $att->time_out }}</td>
                                            <td><a data-id="{{ $att->id }}"
                                                    class="btn btn-sm btn-success btnEditCashAdvance"><i
                                                        class="fa-solid fa-user-pen"></i></a>

                                                <a data-del="{{ $att->id }}"
                                                    class="btn btn-sm btn-danger btnDeleteCashAdvance"><i
                                                        class="fa-solid fa-delete-left"></i></a>
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
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newDeduction">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add new deduction
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deduction as $de)
                                            <tr>
                                                <td>{{ $de->description }}</td>
                                                <td>{{ $de->amount }}</td>
                                                <td><a data-id="{{ $de->id }}"
                                                        class="btn btn-sm btn-success btnEditDeduction"><i
                                                            class="fa-solid fa-user-pen"></i></a>

                                                    <a data-del="{{ $de->id }}"
                                                        class="btn btn-sm btn-danger btnDeleteDeduction"><i
                                                            class="fa-solid fa-delete-left"></i></a>
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
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newCashAdvance">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add new cash advance
                                            </span>
                                        </button></h3>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cashadvance as $ca)
                                            <tr>
                                                <td>{{ $ca->date }}</td>
                                                <td>{{ $ca->employee->employee_code }}</td>
                                                <td>{{ $ca->employee->first_name }}{{ $ca->employee->last_name }}</td>
                                                <td>{{ $ca->description }}</td>
                                                <td>{{ $ca->amount }}</td>
                                                <td><a data-id="{{ $ca->id }}"
                                                        class="btn btn-sm btn-success btnEditCashAdvance"><i
                                                            class="fa-solid fa-user-pen"></i></a>

                                                    <a data-del="{{ $ca->id }}"
                                                        class="btn btn-sm btn-danger btnDeleteCashAdvance"><i
                                                            class="fa-solid fa-delete-left"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <div class="order">
                                <div class="head">
                                    <h3> </h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>

                                        <tr>
                                            <th>Employee Code</th>
                                            <th>Name</th>
                                            <th>Total Working hours</th>
                                            <th>Cash Advance</th>
                                            <th>Deduction</th>
                                            <th>Gross Pay</th>
                                            <th>Net Pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // EDIT scripts for modals
            $(document).on('click', '.btnEditCashAdvance', function() {
                var cashAdvanceId = $(this).attr("data-id");
                var url = "/editCashAdvance";
                $.get(url + '/' + cashAdvanceId, function(data) {
                    //success data
                    $('#cashAdvanceId').val(data.cashAd.id);
                    $('#employee').val(data.emp.first_name + ' ' + data.emp.last_name);
                    $('#date').val(data.cashAd.date);
                    $('#amount').val(data.cashAd.amount);
                    $('#description').val(data.cashAd.description);
                    $('#CashAdvanceEditModal').modal('show');
                })
            });

            $(document).on('click', '.btnEditDeduction', function() {
                var deductionId = $(this).attr("data-id");
                var url = "/editDeduction";
                $.get(url + '/' + deductionId, function(data) {
                    //success data
                    $('#deductionId').val(data.id);
                    $('#deductionAmount').val(data.amount);
                    $('#deductionDescription').val(data.description);
                    $('#DeductionEditModal').modal('show');
                })
            });

            // DELETE MODAL
            $('.btnDeleteCashAdvance').on('click', function() {
                const cashadvance_id = $(this).attr("data-del");
                $('.cashAdvanceId').val(cashadvance_id);
                $('#deleteCashAdvanceModal').modal('show');
            });
            $('.btnDeleteDeduction').on('click', function() {
                const deduction_id = $(this).attr("data-del");
                $('.deductionId').val(deduction_id);
                $('#deleteDeductionModal').modal('show');
            });
        });
    </script>
@endsection
