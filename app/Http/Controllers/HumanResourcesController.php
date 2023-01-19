<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HumanResources\schedules;
use App\Models\HumanResources\job;
use App\Models\HumanResources\department;
use App\Models\HumanResources\employee;

use DB;
use Carbon\Carbon;

class HumanResourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $sched = DB::table('schedule')->get()->whereNull('deleted_at');
        $job = DB::table('job')->get()->whereNull('deleted_at');
        $depart = DB::table('department')->get()->whereNull('deleted_at');

        $employee = employee::with('job', 'department')->get()->whereNull('deleted_at');

        $workformat = DB::table('employee')
                    ->join('department', 'employee.department_id', '=', 'department.id')
                    ->select( DB::raw('count(employee.id) as total'), 'department.department_name')
                    ->groupBy('department.department_name')
                    ->get();

        $empMonth = DB::table('employee')
                    ->select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(id) as total'))
                    ->groupBy('month')
                    ->orderBy('created_at')
                    ->get();

        $empCount       = $employee->count();
        $departCount    = $depart->count();
        $jobCount       = $job->count();
        $schedCount       = $sched->count();

        return view('human_resources.employee', compact('employee', 'empCount', 'departCount', 'depart', 'job', 'sched', 'departCount', 'jobCount', 'schedCount' , 'empMonth', 'workformat'));
    }

    public function registration(){
        return view('human_resources.registration_form');
    }
    //  =====================SCHEDULE CONTROLLER========================//
    public function storeSchedule(Request $request){
        $sched = new schedules;

        $sched->time_in = $request->input('time_in');
        $sched->time_out = $request->input('time_out');
        $sched->save();
        
        $msg = "New Schedule has been created.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function editSchedule($id){
        $schedule = new schedules;
        
        $sched = $schedule::find($id);
        return response()->json($sched);

    }
    public function updateSchedule(Request $request){

        $id = $request->input('sched_id');

        $time_in = $request->input('time_in');
        $time_out = $request->input('time_out');

        DB::table('schedule')
            ->where('id', $id)
            ->update([
                'time_in' => $time_in,
                'time_out' => $time_out,
            ]);
            $msg = "Schedule has been Updated";

        return redirect()->back()->with(['msg' => $msg]);
    }
    public function deleteSchedule(Request $request){
        $id = $request->input('sched_id');

        DB::table('schedule')
        ->where('id', $id)
        ->update([
            'deleted_at' => now(),
        ]);
        $msg = "Schedule has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
    //  =====================SCHEDULE CONTROLLER========================//

    //  =====================JOB CONTROLLER========================//
    public function storeJob(Request $request){
        $job = new job;

        $job->job_name = $request->input('job_name');
        $job->manager = $request->input('manager');
        $job->description = $request->input('description');
        $job->rate = $request->input('rate');
        $job->save();

        $msg = "New $job->job_name Job has been created.";
        return redirect()->back()->with(['msg' => $msg]);
    }

    public function editJob($id){
        $job = new job;
        
        $job1 = $job::find($id);
        return response()->json($job1);
    }

    public function updateJob(Request $request){

        $id = $request->input('id');

        $job_name = $request->input('job_name');
        $manager = $request->input('manager');
        $rate = $request->input('rate');
        $description = $request->input('description');

        DB::table('job')
            ->where('id', $id)
            ->update([
                'job_name' => $job_name,
                'rate' => $rate,
                'manager' => $manager,
                'description' => $description,
            ]);
            $msg = "$job_name has been Updated";

        return redirect()->back()->with(['msg' => $msg]);
    }
    public function deleteJob(Request $request){
        $id = $request->input('job_id');

        DB::table('job')
        ->where('id', $id)
        ->update([
            'deleted_at' => now(),
        ]);
        $msg = "Job has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }

    //  =====================JOB CONTROLLER========================//


    //  =====================DEPARTMENT CONTROLLER========================//
    public function storeDepartment(Request $request){
        $depart = new department;

        $depart->department_name = $request->input('department_name');
        $depart->save();

        $msg = "New $depart->department_name Department has been created.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function editDepartment($id){
        $department = new department;
        
        $depart = $department::find($id);
        return response()->json($depart);

    }
    public function updateDepartment(Request $request){

        $id = $request->input('depart_id');

        $department_name = $request->input('department_name');


        DB::table('department')
            ->where('id', $id)
            ->update([
                'department_name' => $department_name,
            ]);
            $msg = "Department has been Updated";

        return redirect()->back()->with(['msg' => $msg]);
    }
    public function deleteDepartment(Request $request){
        $id = $request->input('department_id');

        DB::table('department')
        ->where('id', $id)
        ->update([
            'deleted_at' => date("Y-m-d H:i:s"),
        ]);
        $msg = "Department has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
    //  =====================DEPARTMENT CONTROLLER========================//

    //  =====================EMPLOYEE CONTROLLER========================//
    public function storeEmployee(Request $request){
        $emp = new employee;

        $emp->employee_code = $request->input('emp_code');
        $emp->first_name = $request->input('first_name');
        $emp->last_name = $request->input('last_name');
        $emp->address = $request->input('address');
        $emp->birthdate = $request->input('birthdate');
        $emp->contact_number = $request->input('contact_number');
        $emp->gender = $request->input('gender');
        $emp->email = $request->input('email');
        $emp->department_id = $request->input('department');
        $emp->job_id = $request->input('job');
        $emp->schedule_id = $request->input('schedule');
        $emp->manager = $request->input('manager');
        $emp->save();

        $msg = "$emp->first_name $emp->last_name has been Added";

        return redirect()->back()->with(['msg' => $msg]);
    }

    public function editEmployee($id){
        $emp = new employee;
        
        $emp1 = $emp::find($id);
        return response()->json($emp1);

    }

    public function updateEmployee(Request $request){

        $id = $request->input('employeeId');

        $employee_code = $request->input('emp_code');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $birthdate = $request->input('birthdate');
        $contact_number = $request->input('contact_number');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $department_id = $request->input('department');
        $job_id = $request->input('job');
        $schedule_id = $request->input('schedule');
        $manager = $request->input('manager');

        DB::table('employee')
            ->where('id', $id)
            ->update([
                'employee_code' => $employee_code,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'address' => $address,
                'birthdate' => $birthdate,
                'contact_number' => $contact_number,
                'gender' => $gender,
                'email' => $email,
                'department_id' => $department_id,
                'job_id' => $job_id,
                'schedule_id' => $schedule_id,
                'manager' => $manager,
            ]);
            $msg = "$employee_code has been Updated";

        return redirect()->back()->with(['msg' => $msg]);
    }

    public function deleteEmployee(Request $request){
        $id = $request->input('employeeId');

        DB::table('employee')
        ->where('id', $id)
        ->update([
            'deleted_at' => now(),
        ]);
        $msg = "Employee has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
     
    //  =====================EMPLOYEE CONTROLLER========================//
}