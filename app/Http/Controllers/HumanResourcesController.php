<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HumanResources\schedules;
use App\Models\HumanResources\job;
use App\Models\HumanResources\department;
use App\Models\HumanResources\employee;

use DB;

class HumanResourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $sched = DB::table('schedule')->get();
        $job = DB::table('job')->get();
        $depart = DB::table('department')->get();
        $emp = DB::table('employee')->get();
        
        $empCount       = $emp->count();
        $departCount    = $depart->count();
        $jobCount       = $job->count();

        $data=[
            'sched'         => $sched,
            'job'           => $job,
            'depart'        => $depart,
            'employee'      => $emp,
            'empCount'      => $empCount,
            'depCount'      => $departCount,
            'jobCount'      => $jobCount,
        ];

        return view('human_resources.employee', $data);
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
    //  =====================SCHEDULE CONTROLLER========================//

    //  =====================JOB CONTROLLER========================//
    public function storeJob(Request $request){
        $job = new job;

        $job->job_name = $request->input('job_name');
        $job->description = $request->input('description');
        $job->rate = $request->input('rate');
        $job->save();

        $msg = "New $job->job_name Job has been created.";
        return redirect()->back()->with(['msg' => $msg]);
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
        $emp->save();

        $msg = "$emp->first_name $emp->last_name has been Added";

        return redirect()->back()->with(['msg' => $msg]);
    }

    //  =====================EMPLOYEE CONTROLLER========================//
}
