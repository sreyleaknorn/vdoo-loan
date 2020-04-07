<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function payment()
    {
        $data['sh'] = 'all';
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['payments'] = [];
        $data['shops'] = DB::table('phone_shops')
            ->where('active', 1)
            ->get();
        return view('reports.payment', $data);
    }
    public function search_payment(Request $r)
    {
        $data['sh'] = $r->shop;
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        
        $data['shops'] = DB::table('phone_shops')
            ->where('active', 1)
            ->get();
        $q =  DB::table('loanschedules')
            ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
            ->join('customers', 'customers.id', '=', 'loans.customer_id')
            ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
            ->where('loanschedules.active', 1)
            ->where('loanschedules.pay_date', '>=', $r->start)
            ->where('loanschedules.pay_date', '<=', $r->end)
            ->where('loanschedules.due_amount','<=', 0);
        if($r->shop!='all')
        {
            $q = $q->where('loans.shop_id', $r->shop);
        }
        $data['payments']  =  $q->select('loanschedules.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
            ->orderBy('loanschedules.pay_date' , 'ASC')
            ->get();
        return view('reports.payment', $data);
    }
    public function print_payment(Request $r)
    {
       
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $q =  DB::table('loanschedules')
            ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
            ->join('customers', 'customers.id', '=', 'loans.customer_id')
            ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
            ->where('loanschedules.active', 1)
            ->where('loanschedules.pay_date', '>=', $r->start)
            ->where('loanschedules.pay_date', '<=', $r->end)
            ->where('loanschedules.due_amount','<=', 0);
        if($r->sid!='all')
        {
            $q = $q->where('loans.shop_id', $r->sid);
        }
        $data['payments']  =  $q->select('loanschedules.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
            ->orderBy('loanschedules.pay_date' , 'ASC')
            ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.payment-print', $data);
    }
}
