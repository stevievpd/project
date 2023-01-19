@extends('layouts.app')
@section('content')
    @include('layouts.modals')
    <link rel="stylesheet" href="/css/humanresources/style.registration_form.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


    <main id="main-data">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
        <div class="container shadow p-3 mb-5 bg-body rounded">
            <form class="row g-3" action="/addEmployee" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="banner">
                    <h1>Employee Data Form</h1>
                </div>
                <div class="col-lg-12 well">
                    <div class="row gx-4">
                        <div class="col-6">
                            <div>
                                <h3>Personal Data</h3>
                            </div>
                            <div class="col-12 form-floating">
                                <input type="text" class="form-control empCode text-center"
                                    value="VPD-<?php echo (new DateTime())->format('my'); ?>00{{ $empCount}}" name="emp_code" required
                                    style="opacity: 50%;" readonly="true">
                                <label for="firstName">Employee Code</label>
                            </div>

                            <div class="row">
                                <div class="form-floating mb-3 col-4">
                                    <input type="text" class="form-control" name="last_name" required>
                                    <label for="floatingFullname" class="forLabel">Last Name</label>
                                </div>
                                <div class="form-floating mb-3 col-4">
                                    <input type="text" class="form-control" name="first_name" required>
                                    <label for="floatingFullname" class="forLabel">First Name</label>
                                </div>
                                <div class="form-floating mb-3 col-4">
                                    <input type="text" class="form-control" name="middle_name">
                                    <label for="floatingFullname" class="forLabel">Middle Name</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="date" class="form-control" name="bdate" required>
                                    <label for="floatingFullname" class="forLabel">Date of Birth</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" aria-label="Default select example"
                                        style="color: rgb(58, 54, 54);" name="civil_status" required>
                                        <option selected style="color: gray;">Select</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                    <label for="floatingTextarea" class="forLabel">Civil Status</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" name="contact_number" required>
                                    <label for="floatingFullname" class="forLabel">Contact Number</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" aria-label="Default select example"
                                        style="color: rgb(58, 54, 54);" name="gender" required>
                                        <option selected style="color: gray;">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Prefer not to respond">Prefer not to respond</option>
                                    </select>
                                    <label for="floatingTextarea" class="forLabel">Gender</label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" required>
                                <label for="floatingFullname">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="floatingTextarea" name="present_add"></textarea>
                                <label for="floatingTextarea">Present Address</label>
                                <div id="addressHelp" class="form-text">Leave 'Present Address' Blank if Not Applicable
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="floatingTextarea" name="perma_add"></textarea>
                                <label for="floatingTextarea">Permanent Address</label>
                            </div>
                            <div>
                                <h3>Benefits</h3>
                            </div>
                            <div class="benefit row">
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" name="sss">
                                    <label for="floatingFullname" class="forLabel">SSS Number</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" name="tin">
                                    <label for="floatingFullname" class="forLabel">TIN</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" name="pagibig">
                                    <label for="floatingFullname" class="forLabel">Pag-ibig Funds MID</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" name="philhealth">
                                    <label for="floatingFullname" class="forLabel">PhilHealth Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <h3>Educational Attainment</h3>
                            </div>
                            <div class="row">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="elementary">
                                    <label for="floatingFullname" class="forLabel">Elementary</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="elem_year" id="datepicker" />
                                    <label for="floatingFullname" class="forLabel">Year Graduated</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="higschool">
                                    <label for="floatingFullname" class="forLabel">HighSchool</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="high_year" id="datepickerHigh" />
                                    <label for="floatingFullname" class="forLabel">Year Graduated</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="college">
                                    <label for="floatingFullname" class="forLabel">College</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="college_year"
                                        id="datepickerCollege" />
                                    <label for="floatingFullname" class="forLabel">Year Graduated</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="texat" class="form-control" name="degree">
                                    <label for="floatingFullname" class="forLabel">Degree</label>
                                </div>

                            </div>
                            <div>
                                <h3>Work Format</h3>
                            </div>
                            <div class="row">
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" aria-label="Default select example" name="job"
                                        required>
                                        <option selected style="color: gray;">Select Position</option>
                                        @foreach ($job as $j)
                                            <option value="{{ $j->id }}">{{ $j->job_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingTextarea" class="forLabel">Position</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" aria-label="Default select example" name="manager"
                                        required>
                                        <option selected style="color: gray;">Select Manager</option>
                                        <option value="Manager/Team Leader">I'm a Manager/Team Leader</option>
                                        @foreach ($employee as $emp)
                                            @if ($emp->job->manager == 1)
                                                <option value="{{ $emp->first_name }} {{ $emp->last_name }}">
                                                    {{ $emp->first_name }}
                                                    {{ $emp->last_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="floatingTextarea" class="forLabel">Manager</label>
                                    <div id="emailHelp" class="form-text">Put the Team Leader or Manager if applicable
                                    </div>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" aria-label="Default select example" name="department"
                                        required>
                                        <option selected style="color: gray;">Select Department</option>
                                        @foreach ($depart as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingTextarea" class="forLabel">Department</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" aria-label="Default select example" name="schedule"
                                        required>
                                        <option selected style="color: gray;">Select Schedule</option>
                                        @foreach ($sched as $s)
                                            <option value="{{ $s->id }}">{{ $s->time_in }} - {{ $s->time_out }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingTextarea" class="forLabel">Work Schedule</label>
                                </div>
                                <div class="text-center">
                                    <span>
                                        VPD Business Solutions Inc.
                                        Shifting your Ways
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="button-46" role="button" name="addEmployee">Save Employee
                        Data</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
            $("#datepickerHigh").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
            $("#datepickerCollege").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        })
    </script>
@endsection
