@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/humanresources/style.employee.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('sidebar_content')
@section('content')
    <!-- ====================================MODAL================= -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Start Add Employee -->
    <div class="modal fade" id="newEmployee" tabindex="-1" role="dialog" aria-labelledby="employeeTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeTitle">Add employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body  ">

                    <form class="row g-3" action="/addEmployee" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="col-12 form-floating">
                            <input type="text" class="form-control empCode text-center"
                                value="VPD-<?php echo (new DateTime())->format('my') ?>-xxxx" name="emp_code" required style="opacity: 50%;">
                            <label for="firstName">Employee Code</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control firstName" name="first_name" required>
                            <label for="firstName">First name</label>
                        </div>

                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control lastName" name="last_name" required>
                            <label for="lastName">Last name</label>
                        </div>
                        <div class="col form-floating">
                            <textarea class="form-control tArea addressInfo" rows="2" name="address" required></textarea>
                            <label for="addressInfo">Address</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control birthDate datepicker" name="birthdate" required>
                            <label for="birthDate">Birthdate</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="number" class="form-control contactInfo" name="contact_number" required>
                            <label for="contactInfo">Contact Info</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <select class="form-select genderSelection" name="gender" aria-label="Select gender">
                                <option value="" selected>- Select -</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="genderSelection">Gender</label>
                        </div>
                        <div class="col-12 form-floating">
                            <input type="email" class="form-control email" name="email" required>
                            <label for="Email">Email</label>
                        </div>
                        <div class="col-12 form-floating">
                            <select class="form-control departmentSelection" name="department"
                                aria-label="Select department" required>
                                <option value="0" selected>- Select -</option>
                                @foreach ($depart as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->department_name }}</option>
                                @endforeach

                            </select>
                            <label for="departmentSelection">Department</label>
                        </div>
                        <div class="col-12 form-floating">
                            <select class="form-control jobSelection" name="job" aria-label="Select job" required>
                                <option value="0" selected>- Select -</option>
                                @foreach ($job as $j)
                                    <option value="{{ $j->id }}">{{ $j->job_name }}</option>
                                @endforeach
                            </select>
                            <label for="jobSelection">Job</label>
                        </div>
                        <div class="col-12 form-floating">
                            <select class="form-control -Selection" name="schedule" aria-label="Select schedule" required>
                                <option value="0" selected>- Select -</option>
                                @foreach ($sched as $s)
                                    <option value="{{ $s->id }}">{{ $s->time_in }} - {{ $s->time_out }}</option>
                                @endforeach
                            </select>
                            <label for="scheduleSelection">Schedule</label>
                        </div>
                        <div class="col-md-12">
                            <label for="filename">Photo</label>
                            <input type="file" class="form-control fileName" name="empImage" accept="image/*">

                        </div>
                        <div class="mb-2">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Cancel</button>
                            <button type="submit" class="btn btn-primary float-end" name="addEmployee">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Employee -->

    <!-- START EDIT MODAL -->
    <div class="modal fade" id="EmployeeEditModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeTitle">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body  ">

                    <form class="row g-3" action="" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <div class="col-12 form-floating">
                            <input type="hidden" id="empId" name="employeeId">
                            <input type="text" class="form-control empCode text-center" id="empCode"
                                name="emp_code" disabled style="opacity: 50%;">
                            <label for="firstName">Employee Code</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control firstName" id="fName" name="firstname"
                                required>
                            <label for="firstName">First name</label>
                        </div>

                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control lastName" id="lName" name="lastname" required>
                            <label for="lastName">Last name</label>
                        </div>
                        <div class="col form-floating">
                            <textarea class="form-control tArea addressInfo" id="add" rows="2" name="address" required></textarea>
                            <label for="addressInfo">Address</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control birthDate datepicker" id="bday"
                                name="birthdate" required>
                            <label for="birthDate">Birthdate</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="number" class="form-control contactInfo" id="contact" name="contact"
                                required>
                            <label for="contactInfo">Contact Info</label>
                        </div>
                        <div class="col-md-6 form-floating genderSelect">
                            <select class="form-select genderSelection" id="gender" name="gender"
                                aria-label="Select gender">

                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="genderSelection">Gender</label>
                        </div>
                        <div class="col-12 form-floating">
                            <input type="email" class="form-control email" id="email" name="email" required>
                            <label for="Email">Email</label>
                        </div>
                        <div class="col-12 form-floating departSelect">
                            <select class="form-control departmentSelection" name="department"
                                aria-label="Select department" required>


                            </select>
                            <label for="departmentSelection">Department</label>
                        </div>
                        <div class="col-12 form-floating jobSelect">
                            <select class="form-control jobSelection" name="job" aria-label="Select job" required>


                            </select>
                            <label for="jobSelection">Job</label>
                        </div>
                        <div class="col-12 form-floating schedSelect">
                            <select class="form-control -Selection" name="schedule" aria-label="Select schedule"
                                required>

                            </select>
                            <label for="scheduleSelection">Schedule</label>
                        </div>
                        <div class="mb-2">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Cancel</button>
                            <button type="submit" class="btn btn-primary float-end"
                                name="updateEmployee">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT MODAL -->

    <!-- START DELETE MODAL -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100 text-center">Are you sure?</h4>

                </div>
                <form class="row g-3" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" class="empId" name="employee_id">
                        <p>Do you really want to delete these Employee? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                </form>
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
    </div>
    <!-- END DELETE MODAL -->

    <!-- PROFILE MODAL -->
    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- sample -->
                    <div class="row g-2">
                        <div class="col-md-4 gradient-custom text-center text-white detail"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="" alt="Avatar" class="img-fluid my-5 shadow p-3 mb-5 bg-white rounded"
                                id="pic" style="width: 150px; border-radius: 50%;" />
                            <h5>Unknown</h5>
                            <p>Not Set</p>
                            <!-- <i class="far fa-edit mb-5"></i> -->
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3 emails">
                                        <h6>Email</h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                    <div class="col-6 mb-3 phone">
                                        <h6>Phone</h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                    <div class="col-6 mb-3 add">
                                        <h6>Address</h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                    <div class="col-6 mb-3 bday">
                                        <h6>Birthdate</h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                </div>
                                <h6>Work Overview</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3 sched">
                                        <h6>Schedule
                                        </h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                    <div class="col-6 mb-3 depart">
                                        <h6>Department</h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                    <div class="col-6 mb-3 rate">
                                        <h6>Rate</h6>
                                        <p class="text-muted">Not Set</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sample -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- PROFILE MODAL -->

    <!-- Start Add Schedule -->
    <div class="modal fade" id="newSchedule" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeTitle">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form class="row g-3" action="/addSchedule" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="col-md-6 form-floating">
                            <input type="time" class="form-control timeIn" name="time_in" required>
                            <label for="Time In">Time In</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="time" class="form-control timeOut" name="time_out" required>
                            <label for="Time Out">Time Out</label>
                        </div>

                        <div class="mb-2">
                            <button type="button" data-bs-dismiss="modal"
                                class="btn btn-danger opacity-75">Cancel</button>
                            <button type="submit" class="btn btn-success opacity-75 float-end"
                                name="addEmployee">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add SCHEDULE -->

    <!-- Start Add Job -->
    <div class="modal fade" id="newJob" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeTitle">Add Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form class="row g-3" action="/addJob" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control jobName" name="job_name" required>
                            <label for="Job Name">Job</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="number" step="0.01" class="form-control rate" name="rate" required>
                            <label for="Rate">Rate</label>
                        </div>
                        <div class="col-md-12 form-floating">
                            <input type="text" class="form-control descript" name="description" required>
                            <label for="Description">Description</label>
                        </div>

                        <div class="mb-2">
                            <button type="button" data-bs-dismiss="modal"
                                class="btn btn-danger opacity-75">Cancel</button>
                            <button type="submit" class="btn btn-success opacity-75 float-end"
                                name="addEmployee">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add JOB -->

    <!-- Start Add DEPARTMENT -->
    <div class="modal fade" id="newDepartment" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeTitle">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form class="row g-3" action="/addDepartment" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf

                        <div class="col-md-12 form-floating">
                            <input type="text" class="form-control depart" name="department_name" required>
                            <label for="Department">Description</label>
                        </div>

                        <div class="mb-2">
                            <button type="button" data-bs-dismiss="modal"
                                class="btn btn-danger opacity-75">Cancel</button>
                            <button type="submit" class="btn btn-success opacity-75 float-end"
                                name="addEmployee">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add DEPARTMENT -->


    <!-- ====================================MODAL ================ -->

    {{-- ============================================================================================================================== --}}
    <div id="container cont-mains empMenu" class=" mx-4" id="main">
        <div id="content" class="" style="width: 80%; margin:auto;">
            <!-- title -->

            <!-- start of content -->
            <div class="row" style="">
                {{-- Employee Stats --}}
                <div class="row align-items-start shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="text-center titleHead  rounded">
                        <h1 class=" titleh1">Employee Statistics</h1>
                    </div>
                    <div class="col-4 containEmp border border-rounded" style="height:32.6vh;">
                        <div class="row emp">
                            <div
                                class="col-6 border border-top-0 border-start-0 border-bottom-0 border-secondary border-opacity-50">
                                <div class="p-3 empTitle">
                                    <h5>Total Employees</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h1>13</h1>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>

                                <p class="text-center">Employees</p>
                            </div>
                            <div
                                class="col-6 border border-top-0 border-start-0 border-bottom-0 border-end-0 border-secondary border-opacity-50">
                                <div class="p-3 empTitle">
                                    <h5>Total Department</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h1>2</h1>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>
                                <p class="text-center">Employees</p>
                            </div>
                            <div class="col-6 border border-start-0 border-bottom-0 border-secondary border-opacity-50">
                                <div class="p-3 empTitle">
                                    <h5>Total Jobs</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h1>10</h1>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>
                                <p class="text-center">Employees</p>
                            </div>
                            <div
                                class="col-6 border border-end-0 border-start-0 border-bottom-0 border-secondary border-opacity-50">
                                <div class="p-3 empTitle">
                                    <h5>Salary</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h1>13</h1>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>
                                <p class="text-center">Employees</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 containEmp border border-rounded graphBox" style="height:32.6vh;">
                        <canvas id="myChart" class="canvasJS" style="width:100vw;"></canvas>
                    </div>
                    <!-- new design end -->
                </div>
                {{-- Employee Stats end --}}

                {{-- Employee Details --}}
                <div class="row align-items-start  employee ">
                    <div class="col-7 col-md-offset-1 shadow-sm p-3 mb-5 bg-body rounded employeList">
                        <div class="text-center titleHead  rounded">
                            <h1 class=" titleh1">Employee Status</h1>
                        </div>
                        <div>
                            <ul class="nav nav-tabs" id="employeeTab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="employeeTableTab" data-bs-toggle="tab"
                                        data-bs-target="#employeeTable" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">List of Employees</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="scheduleTable" data-bs-toggle="tab"
                                        data-bs-target="#scheduleTab" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">
                                        Schedules</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="jobTable" data-bs-toggle="tab"
                                        data-bs-target="#jobTab" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">Job Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="departmentTable" data-bs-toggle="tab"
                                        data-bs-target="#departmentTab" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">Department</button>
                                </li>

                            </ul>


                            <div id="employeeTabContent" class="tab-content">
                                {{-- ============================================= Employee table NAV START============================================ --}}
                                <div id="employeeTable" class="card tab-pane fade show active  border-0" role="tabpanel"
                                    aria-labelledby="employeeTableTab" tabindex="0">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-sm mt-2"
                                                data-bs-toggle="modal" data-bs-target="#newEmployee">
                                                <span>
                                                    <i class="fa fa-plus"></i>
                                                    Add new employee
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="shadow-sm card-body">
                                        <div class="table-responsive ">
                                            <table id="employeelist" class="table table-borderless display">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col" class="text-center">Employee Code</th>
                                                        <th scope="col" class="text-center">Name</th>
                                                        <th scope="col" class="text-center">Job</th>
                                                        <th scope="col" class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @foreach ($employee as $emp)
                                                        <tr>
                                                            <td>{{ $emp->employee_code }}</td>
                                                            <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                                                            <td>{{ $emp->email }}</td>
                                                            <td> <a data-id="{{ $emp->id }}"
                                                                    class="btn btn-sm btn-success btnEdit"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $emp->id }}"
                                                                    class="btn btn-sm btn-danger btnDelete"><i
                                                                        class="fa-solid fa-delete-left"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="text-center">
                                                    <tr>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                {{-- =============================================Employee table NAV END============================================ --}}

                                {{-- =============================================SCHEDULE table NAV START============================================ --}}

                                <div id="scheduleTab" class="card tab-pane fade border-0" role="tabpanel"
                                    aria-labelledby="scheduleTab" tabindex="0">
                                    <div class="card-header">
                                        <button type="button" class="btn btn-primary btn-sm btn-flat"
                                            data-bs-toggle="modal" data-bs-target="#newSchedule">
                                            <span>
                                                <i class="fa fa-plus"></i>
                                                Add New Schedule
                                            </span>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="empschedule" class="table display">
                                                <thead>

                                                    <tr>
                                                        <th>Time In</th>
                                                        <th>Time Out</th>
                                                        <th>Actions</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    @foreach ($sched as $s)
                                                        <tr>
                                                            <td>{{ $s->time_in }}</td>
                                                            <td>{{ $s->time_out }}</td>
                                                            <td><a data-id="{{ $s->id }}"
                                                                    class="btn btn-sm btn-success btnEdit"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $s->id }}"
                                                                    class="btn btn-sm btn-danger btnDelete"><i
                                                                        class="fa-solid fa-delete-left"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- =============================================Employee table NAV END============================================ --}}

                                {{-- =============================================JOB TABLE NAV START============================================ --}}
                                <div id="jobTab" class="card tab-pane fade border-0" role="tabpanel"
                                    aria-labelledby="employeeJobTab" tabindex="0">
                                    <div class="card-header">
                                        <button type="button" class="btn btn-primary btn-sm btn-flat"
                                            data-bs-toggle="modal" data-bs-target="#newJob">
                                            <span>
                                                <i class="fa fa-plus"></i>
                                                Add New Job
                                            </span>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="empschedule" class="table display">
                                                <thead>
                                                    <tr>
                                                        <th>Job Name</th>
                                                        <th>Description</th>
                                                        <th>Rate</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($job as $job)
                                                        <tr>
                                                            <td>{{ $job->job_name }}</td>
                                                            <td>{{ $job->description }}</td>
                                                            <td>{{ $job->rate }}</td>
                                                            <td><a data-id="{{ $job->id }}"
                                                                    class="btn btn-sm btn-success btnEdit"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $job->id }}"
                                                                    class="btn btn-sm btn-danger btnDelete"><i
                                                                        class="fa-solid fa-delete-left"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                {{-- =============================================JOB table NAV END============================================ --}}
                                {{-- =============================================Department TABLE NAV START============================================ --}}
                                <div id="departmentTab" class="card tab-pane fade border-0" role="tabpanel"
                                    aria-labelledby="departmentTab" tabindex="0">
                                    <div class="card-header">
                                        <button type="button" class="btn btn-primary btn-sm btn-flat"
                                            data-bs-toggle="modal" data-bs-target="#newDepartment">
                                            <span>
                                                <i class="fa fa-plus"></i>
                                                Add New Department
                                            </span>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="empschedule" class="table display">
                                                <thead>
                                                    <tr>
                                                        <th>Department</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($depart as $dep)
                                                        <tr>
                                                            <td>{{ $dep->department_name }}</td>
                                                            <td><a data-id="{{ $dep->id }}"
                                                                    class="btn btn-sm btn-success btnEdit"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $dep->id }}"
                                                                    class="btn btn-sm btn-danger btnDelete"><i
                                                                        class="fa-solid fa-delete-left"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                {{-- =============================================DEpartment table NAV END============================================ --}}

                            </div>

                        </div>
                    </div>
                    <div class="col-4 containEmp shadow-sm  ms-5 bg-body rounded graphBox">
                        <div class="text-center titleHead rounded">
                            <h1 class=" titleh1">Working Format</h1>
                        </div>
                        <div class="box">
                            <canvas id="pieCHartJS" class="canvasJSpie" style="margin-left: 40px"></canvas>
                        </div>

                    </div>
                </div>
                {{-- Employee Details End --}}
            </div>
        </div>

        <!-- end of content -->
    </div>
    {{-- ============================================================================================================================== --}}

    <style>
        body {
            background-color: #EAF6F6;
        }
    </style>
    {{-- scripts --}}


    <script>
        //bar chart
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Employee',
                    data: [12, 59, 5, 56, 58, 12, 59, 87, 45, 65, 40, 12],
                    backgroundColor: 'rgb(113,82,243)'
                }, {
                    label: 'Working Hours',
                    data: [12, 59, 5, 56, 58, 12, 59, 85, 23, 25, 84, 14],
                }],
            },
            options: {
                tooltips: {
                    displayColors: true,
                    callbacks: {
                        mode: 'x',
                    },
                },
                scales: {
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                        },
                        type: 'linear',
                    }]
                },
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
            }
        });
    </script>
    <script>
        //Pie Chart
        const ctxs = document.getElementById('pieCHartJS');

        new Chart(ctxs, {
            type: 'polarArea',
            data: {
                labels: ['IT', 'Creatives', 'Sales', ],
                datasets: [{
                    label: 'Job Statistics',
                    data: [3, 3, 2, ],
                    borderWidth: 1
                }]
            },
            options: {

            }
        });
    </script>
@endsection
@endsection
