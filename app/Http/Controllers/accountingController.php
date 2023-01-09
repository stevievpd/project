<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounting\account_list;
use App\Models\Accounting\group_list;
use App\Models\Accounting\journal_entry;
use App\Models\Accounting\journal_item;
use App\Models\HumanResources\employee;

use DB;

class accountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $journalEntry = journal_entry::with(['employee','journal_item' => function($acc){
                $acc
                    ->with('account_list');
                    }])->get();

                    $accountList = account_list::orderBy('account_name', 'asc')->get();
                    $groupList = group_list::orderBy('group_name', 'asc')->get();
                    $employee = employee::orderBy('first_name', 'asc')->get();
       
        return view('accounting.journalEntry', compact('journalEntry','accountList', 'groupList', 'employee'));
    }
    // STORE JOURNAL ENTRIES and ITEMS
    public function storeJournalEntry(Request $request){
        $journ = new journal_entry;
        $items = new journal_item;

        $journ->employee_id = $request->input('employee_id');
        $journ->entry_code  = $request->input('entry_code');
        $journ->description = $request->input('description');
        $journ->entry_date  = $request->input('entry_date');
        $journ->partner     = $request->input('partner');
        $journ->save();

        foreach($request->account_ids as $key => $value){
            journal_item::create([
                'account_id' => $request->account_ids[$key],
                'group_id'   => $request->group_ids[$key],
                'journal_id' => 1,
                'amount'     => $request->amounts[$key],
                'type'       => $request->amountType[$key],
            ]);
        }
        $msg = "New Schedule has been created.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function generalLedger(){

        $ledger = journal_item::with(['account_list','entry'])      
                ->groupBy('account_id')
                ->get();

        $ledgeritems = journal_item::with(['account_list','entry'=> function($journ){
            $journ
            ->orderBy('description', 'ASC');
            }])
        ->get();

        return view('accounting.general_ledger', compact( 'ledger', 'ledgeritems'));
    }

    public function partnerLedger(){
        $partner = journal_entry::with(['employee','journal_item' => function($acc){
            $acc
                ->with('account_list');
                }])
                ->groupBy('partner')
                ->get();
        $partneritem = journal_entry::with(['journal_item' => function($sd){
                $sd
                ->with('account_list');
                }])
                ->get();
         $ledgeritems = journal_item::with(['account_list','entry'=> function($journ){
                    $journ
                    ->orderBy('description', 'ASC');
                    }])
                    ->get();
                    
        

        return view('accounting.partner_ledger', compact('partner', 'ledgeritems', 'partneritem'));
    }
}