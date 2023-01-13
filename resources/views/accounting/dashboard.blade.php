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
                    <h3>0</h3>
                    <p>Account List</p>
                </span>
            </li>
            <li>
                <i class='bx bx-book-content'></i></i>
                <span class="text">
                    <h3>0</h3>
                    <p>Group List</p>
                </span>
            </li>
            <li>
                <i class='bx bx-user'></i>
                <span class="text">
                    <h3>0</h3>
                    <p>Total Employees</p>
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
                                <span class="text">Account List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="profile">
                                <span class="text">Group List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="messages">
                                <span class="text">Partners</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tab" data-id="settings">
                                <span class="text">Bank Account</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newAccountListModal">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Account List
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table id="" class="table">
                                    <thead>
                                        <tr class="">
                                            <th scope="col">Account Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newJob">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Job
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Job Name</th>
                                            <th>Description</th>
                                            <th>Rate</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="order">
                                <div class="head">
                                    <h3> <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#newDepartment">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Department
                                            </span>
                                        </button></h3>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Department</th>
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
                                            data-bs-toggle="modal" data-bs-target="#newSchedule">
                                            <span>
                                                <i class='bx bxs-plus-circle'></i>
                                                Add New Schedule
                                            </span>
                                        </button></h3>
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <table>
                                    <thead>

                                        <tr>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Actions</th>
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
    {{-- DATA TABLE --}}
    <script>
        $(document).ready(function() {
            $('#employeeList').DataTable();
        });
    </script>
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
        });
    </script>


@endsection
