<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Accounting\account_list;
use App\Models\Accounting\group_list;
use App\Models\Accounting\journal_entry;
use App\Models\Accounting\journal_item;
use App\Models\Accounting\bank_meta_data;
use App\Models\Accounting\bank_account;
use App\Models\HumanResources\employee;
use App\Models\User;


use DB;

class accountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function account(){
        $accountList = account_list::whereNull('deleted_at')->get();
        $groupList = group_list::whereNull('deleted_at')->get();
        $bankMeta = bank_meta_data::whereNull('deleted_at')->get();
        $bankAccount = bank_account::with('bank_meta')->get()->whereNull('deleted_at');

        $accountCount = $accountList->count();
        $groupCount = $groupList->count();
        $bankCount = $bankAccount->count();
        return view('accounting.account', compact('accountList', 'groupList', 'bankMeta', 'bankAccount', 'accountCount', 'groupCount','bankCount'));
    }
    public function dashboard(){
        return view('accounting.dashboard');
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
        

        $accountList = account_list::orderBy('account_name', 'asc')
                                    ->where('status', 1)
                                    ->get()->whereNull('deleted_at');
        $groupList = group_list::orderBy('group_name', 'asc')
                                    ->where('status', 1)
                                    ->get()->whereNull('deleted_at');
        $journCount = journal_entry::count('id');
        $journal_item = journal_item::whereNull('deleted_at')->get();
       
        return view('accounting.journalEntry', compact('journalEntry','journal_item','accountList', 'groupList', 'journCount','dateStart','dateEnd'));
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
    // edit journal entry
    public function editJournal($id){
        $journ = new journal_entry;
        $item = new journal_item;
        
        $journ1 = $journ::find($id);
        $code = $journ1->entry_code;
        $items = $item::where('journ_code', $code)->get();
        return response()->json([
            "journ" => $journ1,
            "items" => $items,
        ]);

    }
    public function updateJournal(Request $request){
        $id = $request->input('journ_id');
        $code = $request->input('entry_code');
        $entry_date = $request->input('entry_date');
        $user_id = Auth::user()->id;
        $title = $request->input('title');
        $description = $request->input('description');
        $partner = $request->input('partner');


        journal_entry::where('id', $id)
                       ->update([
                        'user_id' => $user_id,
                        'title' => $title,
                        'description' => $description,
                        'entry_date' => $entry_date,
                        'partner' => $partner,
                    ]);

        // update journal items
        $flight = journal_item::where('journ_code', $code);
        $flight->delete();

        foreach($request->account_idsEdit as $key => $value){
            journal_item::create([
                'account_id' => $request->account_idsEdit[$key],
                'group_id'   => $request->group_idsEdit[$key],
                'journ_code' => $code,
                'amount'     => $request->amountsEdit[$key],
                'type'       => $request->amountTypeEdit[$key],
            ]);
        }

        $msg = "Journal Entry $code has been updated.";
        return redirect()->back()->with(['msg' => $msg]);
        }
        
    // ========================ACCOUNT LIST=============================//
    public function addAccountList(Request $request){

        $account_name = $request->input('account_name');
        $status = $request->input('status');
        $description = $request->input('description');

        account_list::create([
            'account_name'  => $account_name,
            'description'   => $description,
            'status'        => $status,
        ]);

        $msg = "New $account_name Account has been Added.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function editAccountList($id){
        $account = account_list::find($id);
        return response()->json($account);
    }

    public function updateAccountList(Request $request){
        $id = $request->input('account_id');
        $account_name = $request->input('account_name');
        $status = $request->input('status');
        $description = $request->input('description');

        account_list::where('id', $id)
                    ->update([
                        'account_name' => $account_name,
                        'status'       => $status,
                        'description'  => $description,
                    ]);
        $msg = "$account_name has been Updated.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function deleteAccountList(Request $request){
        $id = $request->input('account_id');
        account_list::where('id', $id)
            ->update([
            'deleted_at' => now(),
         ]);
        $msg = "Account has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
    // ========================ACCOUNT LIST=============================//
    
    // ========================GROUP LIST=============================//
    public function storeGroupList(Request $request){

        $group_name = $request->input('group_name');
        $description = $request->input('description');
        $status = $request->input('status');
        $type = $request->input('type');

        group_list::create([
            'group_name'    => $group_name,
            'description'   => $description,
            'status'        => $status,
            'type'          => $type,
        ]);
        $msg = "$group_name has been Added.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function editGroupList($id){
        $group = group_list::find($id);
        return response()->json($group);
    }
    public function updateGroupList(Request $request){
        $id = $request->input('group_id');
        $group_name = $request->input('group_name');
        $status = $request->input('status');
        $type = $request->input('type');
        $description = $request->input('description');

        group_list::where('id', $id)
                    ->update([
                        'group_name'   => $group_name,
                        'status'       => $status,
                        'type'         => $type,
                        'description'  => $description,
                    ]);
        $msg = "$group_name has been Updated.";
        return redirect()->back()->with(['msg' => $msg]);
    }
    public function deleteGroupList(Request $request){
        $id = $request->input('group_id');
        group_list::where('id', $id)
            ->update([
            'deleted_at' => now(),
         ]);
        $msg = "Group has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
     // ========================Bank Account=============================//
     public function storeBankAccount(Request $request){

        $meta_id        = $request->input('bank_id');
        $account_number = $request->input('account_number');
        $account_holder = $request->input('account_holder');
        $email          = $request->input('email');
        $company        = $request->input('company');
        $contact        = $request->input('contact');
        $zip            = $request->input('zip');
        $address        = $request->input('address');
        $country        = $request->input('country');

        bank_account::create([
            'bank_meta_id'   => $meta_id,
            'account_number' => $account_number,
            'account_holder' => $account_holder,
            'email'          => $email,
            'contact'        => $contact,
            'address'        => $address,
            'country'        => $country,
            'company'        => $company,
            'zip'            => $zip,
        ]);

        $msg = "Bank Account Account has been Added.";
        return redirect()->back()->with(['msg' => $msg]);
     }

     public function editBankAccount($id){
        $bank = bank_account::find($id);
        return response()->json($bank);
     }
     public function updateBankAccount(Request $request){
        $id = $request->input('bank_id');
        $account_number = $request->input('account_number');
        $account_holder = $request->input('account_holder');
        $email = $request->input('email');
        $company = $request->input('company');
        $contact = $request->input('contact');
        $zip = $request->input('zip');
        $address = $request->input('address');
        $country = $request->input('country');
        bank_account::where('id', $id)
                    ->update([
                        'account_number' => $account_number,
                        'account_holder' => $account_holder,
                        'email'          => $email,
                        'contact'        => $contact,
                        'address'        => $address,
                        'country'        => $country,
                        'company'        => $company,
                        'zip'            => $zip,
                    ]);
        $msg = "Bank Account has been Updated.";
        return redirect()->back()->with(['msg' => $msg]);
     }

     public function deleteBankList(Request $request){
        $id = $request->input('bank_id');
        bank_account::where('id', $id)
            ->update([
            'deleted_at' => now(),
         ]);
        $msg = "Bank Account has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }
     // ========================BANK ACCOUNT=============================//

}