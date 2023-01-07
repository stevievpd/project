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


       
        return view('accounting.journalEntry', compact('journalEntry'));
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