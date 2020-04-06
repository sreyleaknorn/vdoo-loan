<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;
use Carbon\Carbon;

class LoanPaymentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (!Right::check('loanpayment', 'l')) {
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-01');
        $data['end'] = date('Y-m-t');
        $data['loanpayments'] = DB::table('loanpayments')
                ->join('loans', 'loans.id', '=', 'loanpayments.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loanpayments.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where('loanpayments.active', 1)
                ->where('loanpayments.receive_date', '>=', $data['start'])
                ->where('loanpayments.receive_date', '<=', $data['end'])
                ->whereMonth('loanpayments.receive_date', Carbon::now()->month)
                ->orderBy('loanpayments.receive_date', 'DESC')
                ->paginate(config('app.row'));
        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();

        $data['sh'] = 'all';
        $data['q'] = '';
        return view('loanpayments.index', $data);
    }

    public function search(Request $r) {
        if (!Right::check('loanpayment', 'l')) {
            return view('permissions.no');
        }

        $data['sh'] = $r->shop;
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['q'] = '';
        $q = DB::table('loanpayments')
                ->join('loans', 'loans.id', '=', 'loanpayments.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->where('loanpayments.active', 1)
                ->where('loanpayments.receive_date', '>=', $r->start)
                ->where('loanpayments.receive_date', '<=', $r->end);

        if ($r->shop != 'all') {
            $q = $q->where('phone_shops.id', $r->shop);
        }

        $data['loanpayments'] = $q->select('loanpayments.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->orderBy('loanpayments.receive_date', 'DESC')
                ->paginate(config('app.row'));

        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();
        return view('loanpayments.index', $data);
    }

    public function print($id) {
        if (!Right::check('loanpayment', 'l')) {
            return view('permissions.no');
        }
        $data['loanpayment'] = DB::table('loanpayments')
                ->join('loans', 'loans.id', '=', 'loanpayments.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loanpayments.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loanpayments.id', $id]])
                ->first();
        $data['com'] = DB::table('companies')
                ->where('id', 1)
                ->first();

        return view('loanpayments.print', $data);
    }

}
