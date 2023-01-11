<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Accounting\account_list;
use App\Models\Accounting\group_list;
use App\Models\Accounting\journal_entry;
use App\Models\Accounting\journal_item;
use App\Models\HumanResources\employee;
use App\Models\User;


use DB;

class accountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');
        if(!empty($dateStart) && !empty($dateEnd))
        {
            $from = date($dateStart);
            $to = date($dateEnd);
            $journalEntry = journal_entry::with(['user','journal_item' => function($acc){
                    $acc
                    ->with('account_list')->whereNull('deleted_at');
                    }])->whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'ASC')->get()->whereNull('deleted_at');
        }else{
            $journalEntry = journal_entry::with(['user','journal_item' => function($acc){
                $acc
                ->with('account_list');
                }])->orderBy('entry_date', 'ASC')->get()->whereNull('deleted_at');
        }
        

        $accountList = account_list::orderBy('account_name', 'asc')->get();
        $groupList = group_list::orderBy('group_name', 'asc')->get();
        $journCount = journal_entry::count('id');
       
        return view('accounting.journalEntry', compact('journalEntry','accountList', 'groupList', 'journCount','dateStart','dateEnd'));
    }
    // STORE JOURNAL ENTRIES and ITEMS
    public function storeJournalEntry(Request $request){
        $journ = new journal_entry;
        $items = new journal_item;
        $code = $request->input('entry_code');
        $journ->user_id     = Auth::user()->id;
        $journ->entry_code  = $request->input('entry_code');
        $journ->title = $request->input('title');
        $journ->description = $request->input('description');
        $journ->entry_date  = $request->input('entry_date');
        $journ->partner     = $request->input('partner');
        $journ->save();

        foreach($request->account_ids as $key => $value){
            journal_item::create([
                'account_id' => $request->account_ids[$key],
                'group_id'   => $request->group_ids[$key],
                'journ_code' => $code,
                'amount'     => $request->amounts[$key],
                'type'       => $request->amountType[$key],
            ]);
        }
        $msg = "New Journal Entry has been created.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function generalLedger(Request $request){

        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');

        if(!empty($dateStart) && !empty($dateEnd))
        {
            $from = date($dateStart);
            $to = date($dateEnd);
            $ledgeritems = journal_entry::with(['journal_item' => function($acc){
                $acc
                ->with('account_list');
                }])->whereBetween('entry_date', [$from, $to])->get()->whereNull('deleted_at');
        }else{
            $ledgeritems = journal_entry::with(['journal_item' => function($acc){
                $acc
                ->with('account_list') ;
                }])->get()->whereNull('deleted_at');
        }
        
        $ledger = journal_item::with(['account_list','entry'])      
                ->groupBy('account_id')
                ->get();

        

        return view('accounting.general_ledger', compact( 'ledger', 'ledgeritems' ,'dateStart', 'dateEnd'));
    }

    public function partnerLedger(Request $request){
        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');
        if(!empty($dateStart) && !empty($dateEnd))
        {
            $from = date($dateStart);
            $to = date($dateEnd);
            $partner = journal_entry::with(['user','journal_item' => function($acc){
                $acc
                    ->with('account_list');
                    }])->whereNull('deleted_at')
                    ->groupBy('partner')
                    ->whereBetween('entry_date', [$from, $to])->get();
        }else{
            $partner = journal_entry::with(['user','journal_item' => function($acc){
                $acc
                    ->with('account_list');
                    }])->whereNull('deleted_at')
                    ->groupBy('partner')
                    ->get();
        }
        
        $partneritem = journal_entry::with(['journal_item' => function($sd){
                $sd
                ->with('account_list');
                }])
                ->get()->whereNull('deleted_at');
         $ledgeritems = journal_item::with(['account_list','entry'=> function($journ){
                    $journ
                    ->orderBy('description', 'ASC');
                    }])
                    ->get();
        return view('accounting.partner_ledger', compact('partner', 'ledgeritems', 'partneritem','dateStart', 'dateEnd'));
    }
    // DELETE JOURNAL 
    public function deleteJournal(Request $request){
        $id = $request->input('journ_id');
        $code = $request->input('entry_code');

        journal_entry::where('id', $id)
            ->update([
            'deleted_at' => now(),
         ]);
         journal_item::where('journ_code', $code)
            ->update([
            'deleted_at' => now(),
         ]);
        $msg = "Journal $code has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
}