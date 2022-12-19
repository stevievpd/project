@extends('layouts.app')
@extends('layouts.sidebar')
<link rel="stylesheet" href="/css/humanresources/style.employee.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('sidebar_content')
@section('content')
    <div id="container cont-mains empMenu" class=" mx-4" id="main">
        <div id="content" class="" style="width: 80%; margin:auto;">
            <!-- title -->

            <!-- start of content -->
            <div class="row" style="">

                <!-- new design -->
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
                    <div class="col-4 containEmp border border-rounded graphBox" style="height:32.6vh;">
                        <canvas id="myChart" class="canvasJS" style="width:100vw;"></canvas>
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
                            <div class="col-6 border border-start-0 border-bottom-0 border-secondary border-opacity-50">
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
                                class="col-6 border border-end-0 border-start-0 border-bottom-0 border-secondary border-opacity-50">
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
                        </div>
                </div>


                <!-- new design end -->

                <div class="row align-items-start shadow-sm p-3 mb-5 bg-body rounded employee">


                    <div class="col-8 ">
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
                                    <button class="nav-link" id="employeeSchedTab" data-bs-toggle="tab"
                                        data-bs-target="#employeeSchedule" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">Employee Schedules</button>
                                </li>

                            </ul>


                            <div id="employeeTabContent" class="tab-content">

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
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ABC!@#</td>
                                                        <td>Steve Le</td>
                                                        <td>Team Leader</td>
                                                        <td> <a data-id="" class="btn btn-sm btn-success btnEdit"><i
                                                                    class="fa-solid fa-user-pen"></i></a>

                                                            <a data-del="" class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fa-solid fa-delete-left"></i></a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                                <tfoot class="text-center">
                                                    <tr>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div> <!-- employeeTable -->

                                <div id="employeeSchedule" class="card tab-pane fade border-0" role="tabpanel"
                                    aria-labelledby="employeeSchedTab" tabindex="0">
                                    <div class="card-header">
                                        <button type="button" class="btn btn-primary btn-sm btn-flat"
                                            data-bs-toggle="modal" data-bs-target="#newSchedule">
                                            <span>
                                                <i class="fa fa-plus"></i>
                                                New
                                            </span>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="empschedule" class="table display">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Time In</th>
                                                        <th>Time Out</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Time In</th>
                                                        <th>Time Out</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- employeeSchedule -->
                        </div>
                    </div>
                    {{-- <div class="col-4 containEmp border border-rounded canvaJs" style="height:50vh;">
                        <div class="text-center titleHead  rounded">
                            <h1 class=" titleh1">Working Format</h1>
                        </div>
                        <canvas id="pieCHartJS" class="canvasJSpie" style="margin-left: 40px"></canvas>
                    </div> --}}
                    <div class="col-4 containEmp border border-rounded graphBox">
                        <div class="text-center titleHead  rounded">
                            <h1 class=" titleh1">Working Format</h1>
                        </div>
                        <div class="box">
                            <canvas id="pieCHartJS" class="canvasJSpie" style="margin-left: 40px"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end of content -->
        </div>
    </div>
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
                    label: 'Employee Work Hours',
                    data: [7, 1, 4, 9, 13, 3, 2, 6, 1, 7, 9, 11],

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
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
