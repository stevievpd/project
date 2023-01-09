 {{-- =============================================== EMPLOYE MODAL ================================================================ --}}
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
                             value="VPD-<?php echo (new DateTime())->format('my'); ?>-00{{ $empCount + 1 }}" name="emp_code" required
                             style="opacity: 50%;" readonly="true">
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
                                 <option value="{{ $s->id }}">{{ $s->time_in }} - {{ $s->time_out }}
                                 </option>
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

 <!-- START EDIT EMPLOYEE MODAL -->
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

                 <form class="row g-3" action="/updateEmployee" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')

                     <div class="col-12 form-floating">
                         <input type="hidden" id="empId" name="employeeId">
                         <input type="text" class="form-control empCode text-center" id="empCode"
                             name="emp_code" style="opacity: 50%;" readonly="true">
                         <label for="firstName">Employee Code</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="text" class="form-control firstName" id="fName" name="first_name"
                             required>
                         <label for="firstName">First name</label>
                     </div>

                     <div class="col-md-6 form-floating">
                         <input type="text" class="form-control lastName" id="lName" name="last_name"
                             required>
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
                         <input type="number" class="form-control contactInfo" id="contact" name="contact_number"
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
                             @foreach ($depart as $dep)
                                 <option value="{{ $dep->id }}">{{ $dep->department_name }}</option>
                             @endforeach

                         </select>
                         <label for="departmentSelection">Department</label>
                     </div>
                     <div class="col-12 form-floating jobSelect">
                         <select class="form-control jobSelection" name="job" aria-label="Select job" required>
                             @foreach ($job as $j)
                                 <option value="{{ $j->id }}">{{ $j->job_name }}</option>
                             @endforeach

                         </select>
                         <label for="jobSelection">Job</label>
                     </div>
                     <div class="col-12 form-floating schedSelect">
                         <select class="form-control -Selection" name="schedule" aria-label="Select schedule"
                             required>
                             @foreach ($sched as $s)
                                 <option value="{{ $s->id }}">{{ $s->time_in }} - {{ $s->time_out }}
                                 </option>
                             @endforeach
                         </select>
                         <label for="scheduleSelection">Schedule</label>
                     </div>
                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                         <button type="submit" class="btn btn-primary float-end"
                             name="updateEmployee">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- END EDIT EMPLOYEE MODAL -->
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
             <form class="row g-3" action="/deleteEmployee" method="POST" enctype="multipart/form-data"
                 autocomplete="off">
                 @csrf
                 @method('PATCH')

                 <div class="modal-body">
                     <input type="hidden" class="empId" name="employeeId">
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

 {{-- =============================================== EMPLOYE MODAL ================================================================ --}}

 {{-- =============================================== SCHEDULE MODAL ================================================================ --}}
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
                             name="addSchedule">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Add SCHEDULE -->

 <!-- Start EDIT Schedule -->
 <div class="modal fade" id="scheduleEditModal" tabindex="-1" role="dialog" aria-labelledby="scheduleTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="employeeTitle">Edit Schedule</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">

                 <form class="row g-3" action="/updateSchedule" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-md-6 form-floating">
                         <input type="hidden" name="sched_id" id="schedId">
                         <input type="time" class="form-control timeIn" name="time_in" id="timeIn" required>
                         <label for="Time In">Time In</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="time" class="form-control timeOut" name="time_out" id="timeOut" required>
                         <label for="Time Out">Time Out</label>
                     </div>

                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal"
                             class="btn btn-danger opacity-75">Cancel</button>
                         <button type="submit" class="btn btn-success opacity-75 float-end"
                             name="update">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End EDIT SCHEDULE -->
 {{-- START SCHEDULE DELETE MODAL --}}
 <div id="deleteSchedModal" class="modal fade">
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
             <form class="row g-3" action="/deleteSchedule" method="POST" enctype="multipart/form-data"
                 autocomplete="off">
                 @csrf
                 @method('PATCH')

                 <div class="modal-body">
                     <input type="hidden" class="schedId" name="sched_id">
                     <p>Do you really want to delete these Schedule? This process cannot be undone.</p>
                 </div>
                 <div class="modal-footer justify-content-center">
             </form>
             <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
             <button type="submit" class="btn btn-danger">Delete</button>
         </div>
     </div>
 </div>
 </div>
 {{-- END SCHEDULE DELETE MODAL --}}
 {{-- =============================================== SCHEDULE MODAL ================================================================ --}}


 {{-- =============================================== JOB MODAL ================================================================ --}}

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

 {{-- Start Edit Job --}}
 <div class="modal fade" id="jobEditModal" tabindex="-1" role="dialog" aria-labelledby="jobTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="jobTitle">Edit Job</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">

                 <form class="row g-3" action="/updateJob" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                     @method('PATCH')
                     <div class="col-md-6 form-floating">
                         <input type="hidden" id="jobId" name="id">
                         <input type="text" class="form-control jobName" name="job_name" id="jobName" required>
                         <label for="Job Name">Job</label>
                     </div>
                     <div class="col-md-6 form-floating">
                         <input type="number" step="0.01" class="form-control rate" name="rate"
                             id="rate" required>
                         <label for="Rate">Rate</label>
                     </div>
                     <div class="col-md-12 form-floating">
                         <input type="text" class="form-control descript" name="description" id="description"
                             required>
                         <label for="Description">Description</label>
                     </div>

                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal"
                             class="btn btn-danger opacity-75">Cancel</button>
                         <button type="submit" class="btn btn-success opacity-75 float-end"
                             name="updateJob">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 {{-- End Edit Job --}}

 {{-- START DELETE MODAL --}}
 <div id="deleteJobModal" class="modal fade">
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
             <form class="row g-3" action="/deleteJob" method="POST" enctype="multipart/form-data"
                 autocomplete="off">
                 @csrf
                 @method('PATCH')

                 <div class="modal-body">
                     <input type="hidden" class="jobID" name="job_id">
                     <p>Do you really want to delete these Job? This process cannot be undone.</p>
                 </div>
                 <div class="modal-footer justify-content-center">
             </form>
             <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
             <button type="submit" class="btn btn-danger">Delete</button>
         </div>
     </div>
 </div>
 </div>
 {{-- END DELETE MODAL --}}
 {{-- =============================================== JOB MODAL ================================================================ --}}

 {{-- =============================================== DEPARTMENT MODAL ================================================================ --}}
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
 <!-- Start EDIT DEPARTMENT -->
 <div class="modal fade" id="departmentEditModal" tabindex="-1" role="dialog" aria-labelledby="employeeTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="employeeTitle">Edit Department</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">

                 <form class="row g-3" action="/updateDepartment" method="POST" enctype="multipart/form-data"
                     autocomplete="off">
                     @csrf
                    @method('PATCH')
                     <div class="col-md-12 form-floating">
                        <input type="hidden" name="depart_id" id="departId">
                         <input type="text" class="form-control depart" id="departName" name="department_name" required>
                         <label for="Department">Description</label>
                     </div>

                     <div class="mb-2">
                         <button type="button" data-bs-dismiss="modal"
                             class="btn btn-danger opacity-75">Cancel</button>
                         <button type="submit" class="btn btn-success opacity-75 float-end"
                             name="editDepart">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End EDIT DEPARTMENT -->

  {{-- START DELETE MODAL --}}
  <div id="deleteDepartmentModal" class="modal fade">
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
            <form class="row g-3" action="/deleteDepartment" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <input type="hidden" class="departId" name="department_id">
                    <p>Do you really want to delete these Job? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
            </form>
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>
</div>
{{-- END DELETE MODAL --}}
 {{-- =============================================== DEPARTMENT MODAL ================================================================ --}}
