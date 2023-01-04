<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class accountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $data = [
            
        ];
        return view('accounting.journalEntry', $data);
    }
}
