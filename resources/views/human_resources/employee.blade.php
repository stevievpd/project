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
    @include('layouts/modal.HumanResourcesModal')


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
                                    <h1>{{ $empCount }}</h1>
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
                                    <h1>{{ $depCount }}</h1>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>
                                <p class="text-center">Department</p>
                            </div>
                            <div class="col-6 border border-start-0 border-bottom-0 border-secondary border-opacity-50">
                                <div class="p-3 empTitle">
                                    <h5>Total Jobs</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h1>{{ $jobCount }}</h1>
                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>
                                <p class="text-center">Job</p>
                            </div>
                            <div
                                class="col-6 border border-end-0 border-start-0 border-bottom-0 border-secondary border-opacity-50">
                                <div class="p-3 empTitle">
                                    <h5>Total Schedule</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h1>{{ $schedCount }}</h1>

                                    <div class="span-text"> <span class="badge text-bg-success bg-opacity-25 percent"
                                            style="color: green !important"><i class="fa-solid fa-arrow-trend-up"></i>
                                            6%</span>
                                    </div>
                                </div>
                                <p class="text-center">Work Schedule</p>
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
                                    <button class="nav-link" id="jobTable" data-bs-toggle="tab" data-bs-target="#jobTab"
                                        type="button" role="tab" aria-controls="profile-tab-pane"
                                        aria-selected="false">Job Details</button>
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
                                            <table id="employeelist" class="table">
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
                                                            <td>{{ $emp->job_name }}</td>
                                                            <td> <a data-id="{{ $emp->id }}"
                                                                    class="btn btn-sm btn-success btnEditEmp"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $emp->id }}"
                                                                    class="btn btn-sm btn-danger btnDeleteEmp"><i
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

                                <div id="scheduleTab" class="card tab-pane fade border-0 " role="tabpanel"
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
                                            <table id="empschedule" class="table">
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
                                                                    class="btn btn-sm btn-success btnEditSched"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $s->id }}"
                                                                    class="btn btn-sm btn-danger btnDeleteSched"><i
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
                                {{-- =============================================Schedule table NAV END============================================ --}}

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
                                            <table id="jobList" class="table">
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
                                                                    class="btn btn-sm btn-success btnEditJob"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $job->id }}"
                                                                    class="btn btn-sm btn-danger btnDeleteJob"><i
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
                                            <table id="deptList" class="table">
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
                                                                    class="btn btn-sm btn-success btnEditDepart"><i
                                                                        class="fa-solid fa-user-pen"></i></a>

                                                                <a data-del="{{ $dep->id }}"
                                                                    class="btn btn-sm btn-danger btnDeleteDepart"><i
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
    {{-- CRUD SCRIPTS --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // EDIT scripts for modals
            $(document).on('click', '.btnEditEmp', function() {
                var empId = $(this).attr("data-id");
                var url = "/editEmployee";
                $.get(url + '/' + empId, function(data) {
                    //success data
                    $('#empId').val(data.id);
                    $('#empCode').val(data.employee_code);
                    $('#fName').val(data.first_name);
                    $('#lName').val(data.last_name);
                    $('#add').val(data.address);
                    $('#email').val(data.email);
                    $('#bday').val(data.birthdate);
                    $('#contact').val(data.contact_number);
                    $("div.genderSelect select").val(data.gender).change();
                    $("div.departSelect select").val(data.department_id).change();
                    $("div.jobSelect select").val(data.job_id).change();
                    $("div.schedSelect select").val(data.schedule_id).change();
                    $('#EmployeeEditModal').modal('show');
                })
            });

            $(document).on('click', '.btnView', function() {

                var empId = $(this).attr("data-view");
                var pic = $(this).attr("data-pic");
                $("#pic").attr("src", pic);
                $.ajax({
                    method: "POST",
                    url: "",
                    data: {
                        'employee_id': empId,
                    },
                    success: function(response) {

                        $.each(response, function(key, emp) {
                            $(".detail h5").html(emp['firstname'] + '&nbsp' + emp[
                                'lastname']).change();
                            $(".detail p").html(emp['job_name']).change();
                            $(".phone p").html(emp['contact_info']).change();
                            $(".add p").html(emp['address']).change();
                            $(".bday p").html(emp['birthdate']).change();
                            $(".emails p").html(emp['email']).change();
                            $(".sched p").html(emp['time_in'] + ' - ' + emp['time_out'])
                                .change();
                            $(".depart p").html(emp['department_name']).change();
                            $(".rate p").html('Php ' + emp['rate']).change();

                            $('#profileModal').modal('show');
                        });
                    }
                });
            });

            $(document).on('click', '.btnEditJob', function() {
                var jobId = $(this).attr("data-id");
                var url = "/editJob";
                $.get(url + '/' + jobId, function(data) {
                    //success data
                    $('#jobId').val(data.id);
                    $('#jobName').val(data.job_name);
                    $('#rate').val(data.rate);
                    $('#description').val(data.description);
                    $('#jobEditModal').modal('show');
                })
            });
            $(document).on('click', '.btnEditSched', function() {
                var schedId = $(this).attr("data-id");
                var url = "/editSchedule";
                $.get(url + '/' + schedId, function(data) {
                    //success data
                    $('#schedId').val(data.id);
                    $('#timeIn').val(data.time_in);
                    $('#timeOut').val(data.time_out);
                    $('#scheduleEditModal').modal('show');
                })
            });
            $(document).on('click', '.btnEditDepart', function() {
                var departId = $(this).attr("data-id");
                var url = "/editDepartment";
                $.get(url + '/' + departId, function(data) {
                    //success data
                    $('#departId').val(data.id);
                    $('#departName').val(data.department_name);
                    $('#departmentEditModal').modal('show');
                })
            });

            // DELETE scripts for modals
            $('.btnDeleteEmp').on('click', function() {

                const emp_id = $(this).attr("data-del");
                $('.empId').val(emp_id);
                $('#deleteEmployeeModal').modal('show');
            });
            $('.btnDeleteJob').on('click', function() {

                const job_id = $(this).attr("data-del");
                $('.jobId').val(job_id);
                $('#deleteJobModal').modal('show');
            });
            $('.btnDeleteSched').on('click', function() {

                const sched_id = $(this).attr("data-del");
                $('.schedId').val(sched_id);
                $('#deleteJobModal').modal('show');
            });
            $('.btnDeleteDepart').on('click', function() {

                const depart_id = $(this).attr("data-del");
                $('.departId').val(depart_id);
                $('#deleteDepartmentModal').modal('show');
            });
        });
    </script>

    {{-- DATA TABLE --}}
    <script>
        $(document).ready(function() {
            $('#employeelist').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],

            });
            $('#empschedule').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],

            });
            $('#jobList').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],

            });
            $('#deptList').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],

            });
        });
    </script>
    {{-- DATA TABLE --}}

    {{-- graphs --}}
    <script>
        // Employeee statistics
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($empMonth as $month)
                        '{{ $month->month}}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Employee',
                    data: [
                        @foreach ($empMonth as $total )
                            {{ $total->total }},
                        @endforeach
                    ],
                    backgroundColor: 'rgb(113,82,243)'
                }, {
                    label: 'Working Hours',
                    data: [1, 2],
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
        //WORK FORMAT
        const ctxs = document.getElementById('pieCHartJS');

        new Chart(ctxs, {
            type: 'polarArea',
            data: {
                labels: [
                    @foreach ($workformat as $work)
                        '{{ $work->department_name }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Employee',
                    data: [
                        @foreach ($workformat as $work)
                            {{ $work->total }},
                        @endforeach
                    ],
                    borderWidth: 0
                }]
            },
            options: {

            }
        });
    </script>
@endsection
@endsection
