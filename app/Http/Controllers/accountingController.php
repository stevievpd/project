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
        if(!empty($dateStart) && !empty($dateStart))
        {
            $from = date($dateStart);
            $to = date($dateEnd);
            $journalEntry = journal_entry::with(['user','journal_item' => function($acc){
                    $acc
                    ->with('account_list');
                    }])->whereBetween('entry_date', [$from, $to])->get();
        }else{
            $journalEntry = journal_entry::with(['user','journal_item' => function($acc){
                $acc
                ->with('account_list');
                }])->get();
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
    public function generalLedger(){
        $from = date('2023-01-01');
        $to = date('2023-02-02');
        $ledger = journal_item::with(['account_list','entry'])      
                ->groupBy('account_id')
                ->get();

        $ledgeritems = journal_item::with(['account_list','entry'=> function($journ){
            $journ
            ->orderBy('description', 'ASC')->whereBetween('entry_date', [$from, $to]);
            }])
        ->get();

        return view('accounting.general_ledger', compact( 'ledger', 'ledgeritems'));
    }

    public function partnerLedger(){
        $partner = journal_entry::with(['user','journal_item' => function($acc){
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