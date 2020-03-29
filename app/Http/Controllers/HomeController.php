<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['c1'] = DB::table('customers')
            ->where('active', 1)
            ->whereDate('create_at', date('Y-m-d'))
            ->count('id');
        $data['c2'] = DB::table('customers')
            ->where('active', 1)
            ->whereMonth('create_at', date('m'))
            ->count('id');
        $data['c3'] = DB::table('customers')
            ->where('active', 1)
            ->whereYear('create_at', date('Y'))
            ->count('id');
        $data['c4'] = DB::table('customers')
            ->where('active', 1)
            ->count('id');
        $data['p1'] = DB::table('loanpayments')
            ->where('active', 1)
            ->where('receive_date', date('Y-m-d'))
            ->sum('receive_amount');
        $data['p2'] = DB::table('loanpayments')
            ->where('active', 1)
            ->whereMonth('receive_date', date('m'))
            ->sum('receive_amount');
        $data['p3'] = DB::table('loanpayments')
            ->where('active', 1)
            ->whereYear('receive_date', date('Y'))
            ->sum('receive_amount');
        $data['p4'] = DB::table('loanpayments')
            ->where('active', 1)
            ->sum('receive_amount');
        $data['shops'] = DB::table('phone_shops')
            ->where('active', 1)
            ->get();
        $data['loans'] = DB::table('loanschedules')
            ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
            ->join('customers', 'customers.id', '=', 'loans.customer_id')
            ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
            ->where('loanschedules.active', 1)
            ->where('loanschedules.pay_date', date('Y-m-d'))
            ->where('loanschedules.due_amount','>', 0)
            ->select('loanschedules.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
            ->orderBy('loanschedules.pay_date' , 'ASC')
            ->paginate(config('app.row'));
        return view('dashboard', $data);
    }

    public function search(Request $r)
    {
        if(!Right::check('loanschedule', 'l')) 
        {
            return view('permissions.no');
        }
        $q= $r->q;
        $data['q'] = $r->q;
        $data['sh'] = 'all';
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['loanschedules'] = DB::table('loanschedules')
            ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
            ->join('customers', 'customers.id', '=', 'loans.customer_id')
            ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
            ->where('loanschedules.active', 1)
            ->where(function($query) use ($q){
                $query = $query->orWhere('customers.name', 'like', "%{$q}%")
                    ->orWhere('customers.phone', 'like', "%{$q}%");
            })
            ->select('loanschedules.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
            ->orderBy('loanschedules.pay_date' , 'ASC')
            ->paginate(config('app.row'));
        $data['shops'] = DB::table('phone_shops')
            ->where('active', 1)
            ->get();
        return view('loanschedules.index', $data);
    }
    public function search_all(Request $r)
    {
        if(!Right::check('loanschedule', 'l')) 
        {
            return view('permissions.no');
        }

        $data['sh'] = $r->shop;
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['q'] = '';
        $q = DB::table('loanschedules')
            ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
            ->join('customers', 'customers.id', '=', 'loans.customer_id')
            ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
            ->where('loanschedules.active', 1)
            ->where('loanschedules.pay_date','>=', $r->start)
            ->where('loanschedules.pay_date','<=', $r->end);

        if($r->shop!='all')
        {
            $q = $q->where('phone_shops.id', $r->shop);
        }
         
        $data['loanschedules'] = $q->select('loanschedules.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
            ->orderBy('loanschedules.pay_date' , 'ASC')
            ->paginate(config('app.row'));
        $data['shops'] = DB::table('phone_shops')
            ->where('active', 1)
            ->get();
        return view('loanschedules.index', $data);
    }
}
