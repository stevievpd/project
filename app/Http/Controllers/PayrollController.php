<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HumanResources\employee;
use App\Models\Payroll\cashadvance;
use App\Models\Payroll\deduction;
use App\Models\Payroll\attendance;

use DB;

class PayrollController extends Controller
{
    public function index()
    {
        $cashadvance = cashadvance::with('employee')
            ->get()
            ->whereNull('deleted_at');
        $attendance = attendance::with('employee')
            ->get()
            ->whereNull('deleted_at');
        $employee = employee::whereNull('deleted_at')->get();
        $deduction = deduction::whereNull('deleted_at')->get();

        return view('payroll.payroll', compact('cashadvance', 'employee', 'deduction', 'attendance'));
    }

    // CRUD CASH ADVANCE
    public function storeCashAdvance(Request $request)
    {
        $cashadvance = new cashadvance();

        $cashadvance->employee_id = $request->input('employee');
        $cashadvance->description = $request->input('description');
        $cashadvance->date = $request->input('date');
        $cashadvance->amount = $request->input('amount');
        $cashadvance->save();
        $msg = "$cashadvance->first_name $cashadvance->last_name cash advance has been Added";
        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function editCashAdvance($id)
    {
        $cashadvance = new cashadvance();
        $employee = new employee();

        $cashadvance1 = $cashadvance::find($id);
        $emp_id = $cashadvance1->employee_id;
        $employee1 = $employee::find($emp_id);
        return response()->json([
            'cashAd' => $cashadvance1,
            'emp' => $employee1,
        ]);
    }

    public function updateCashAdvance(Request $request)
    {
        $id = $request->input('cashadvance_id');
        $employee_id = $request->input('employee');
        $date = $request->input('date');
        $amount = $request->input('amount');
        $description = $request->input('description');

        cashadvance::where('id', $id)->update([
            'employee_id' => $employee_id,
            'date' => $date,
            'amount' => $amount,
            'description' => $description,
        ]);

        $msg = "$employee_id has been Updated";
        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function deleteCashAdvance(Request $request)
    {
        $id = $request->input('cashadvance_id');
        cashadvance::where('id', $id)->update([
            'deleted_at' => now(),
        ]);
        $msg = 'Cash Advance has been Deleted';

        return redirect()
            ->back()
            ->with(['msgDel' => $msg]);
    }

    // CRUD CASH DEDUCTION
    public function storeDeduction(Request $request)
    {
        $deduction = new deduction();

        $deduction->description = $request->input('description');
        $deduction->amount = $request->input('amount');
        $deduction->save();
        $msg = "$deduction->description has been Added";
        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function editDeduction($id)
    {
        $deduction = new deduction();

        $deduction1 = $deduction::find($id);
        return response()->json($deduction1);
    }
    public function deleteDeduction(Request $request)
    {
        $id = $request->input('deduction_id');
        deduction::where('id', $id)->update([
            'deleted_at' => now(),
        ]);
        $msg = 'Deduction has been Deleted';

        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }
}
