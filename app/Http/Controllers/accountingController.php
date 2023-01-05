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
}
