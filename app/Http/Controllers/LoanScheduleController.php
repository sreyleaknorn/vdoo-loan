<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;
use Carbon\Carbon;

class LoanScheduleController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (!Right::check('loanschedule', 'l')) {
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-01');
        $data['end'] = date('Y-m-t');
        
        $data['loanschedules'] = DB::table('loanschedules')
                ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loanschedules.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loanschedules.active', 1]])
                ->where('loanschedules.pay_date','>=', $data['start'])
                ->where('loanschedules.pay_date','<=', $data['end'])
                ->orderBy('loanschedules.pay_date', 'ASC')
                ->paginate(config('app.row'));
        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();

        $data['sh'] = 'all';
        $data['status'] = 'all';
        $data['q'] = '';
        return view('loanschedules.index', $data);
    }

    public function today() {
        if (!Right::check('loanschedule', 'l')) {
            return view('permissions.no');
        }
        $data['loanschedules'] = DB::table('loanschedules')
                ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loanschedules.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loanschedules.active', 1], ['ispaid', 0], ['pay_date', date('Y-m-d')]])
                ->orderBy('loanschedules.pay_date', 'ASC')
                ->paginate(config('app.row'));
        return view('loanschedules.today', $data);
    }

    public function late() {
        if (!Right::check('loanschedule', 'l')) {
            return view('permissions.no');
        }
        $data['loanschedules'] = DB::table('loanschedules')
                ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loanschedules.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loanschedules.active', 1], ['ispaid', 0], ['pay_date', '<', date('Y-m-d')], ['loans.status' ,'!=' ,'stopped']])
                ->orderBy('loanschedules.pay_date', 'ASC')
                ->paginate(config('app.row'));
        return view('loanschedules.late', $data);
    }

}
