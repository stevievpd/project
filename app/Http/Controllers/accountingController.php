<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounting\account_list;
use App\Models\Accounting\group_list;
use App\Models\Accounting\journal_entry;
use App\Models\Accounting\journal_item;

use DB;

class accountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $journ = new journal_entry;

    
        $journalEntry = journal_entry::with('journal_item')
        
        ->get();


       
        return view('accounting.journalEntry', compact('journalEntry'));
    }
}
