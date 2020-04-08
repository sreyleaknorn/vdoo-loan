<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class ReportController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function payment() {
        if (!Right::check('payment_report', 'l')) {
            return view('permissions.no');
        }
        $data['customers'] = DB::table('customers')
                ->where('active', 1)
                ->orderBy('name')
                ->get();

        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['payments'] = [];
        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();
        $data['sh'] = 'all';
        $data['customer_id'] = 'all';
        $data['q'] = '';
        return view('reports.payment', $data);
    }

    public function search_payment(Request $r) {
        if (!Right::check('payment_report', 'l')) {
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
                ->join('loanschedules', 'loanschedules.id', '=', 'loanpayments.loanschedule_id')
                ->where('loanpayments.active', 1)
                ->where('loanpayments.receive_date', '>=', $r->start)
                ->where('loanpayments.receive_date', '<=', $r->end);

        if ($r->shop != 'all') {
            $q = $q->where('phone_shops.id', $r->shop);
        }


        $data['payments'] = $q->select('loanpayments.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name', 'loanschedules.pay_date as pay_date', 'loanschedules.principal_amount as principal_amount', 'loanschedules.interest_amount as interest_amount', 'loanschedules.total_amount as total_amount', 'loanschedules.paid_amount as paid_amount'
                        , 'loanschedules.paid_date as paid_date')
                ->orderBy('loanpayments.receive_date', 'DESC')
                ->get();

        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();
        $data['customers'] = DB::table('customers')
                ->where('active', 1)
                ->orderBy('name')
                ->get();
        return view('reports.payment', $data);
    }

    public function onhand_print() {
        if (!Right::check('stock_balance', 'l')) {
            return view('permissions.no');
        }
        $data['products'] = DB::table('products')
                ->leftJoin('units', 'products.unit_id', 'units.id')
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->where('products.active', 1)
                ->select('products.*', 'units.name as uname', 'categories.name as cname')
                ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report1-print', $data);
    }

    public function sale() {
        if (!Right::check('sale_report', 'l')) {
            return view('permissions.no');
        }
    }

    /* public function payment()
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
      } */

    public function print_payment(Request $r) {

        $data['sh'] = $r->shop;
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['q'] = '';
        $q = DB::table('loanpayments')
                ->join('loans', 'loans.id', '=', 'loanpayments.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->join('loanschedules', 'loanschedules.id', '=', 'loanpayments.loanschedule_id')
                ->where('loanpayments.active', 1)
                ->where('loanpayments.receive_date', '>=', $r->start)
                ->where('loanpayments.receive_date', '<=', $r->end);

        if ($r->shop != 'all') {
            $q = $q->where('phone_shops.id', $r->shop);
        }

        $data['payments'] = $q->select('loanpayments.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name', 'loanschedules.pay_date as pay_date', 'loanschedules.principal_amount as principal_amount', 'loanschedules.interest_amount as interest_amount', 'loanschedules.total_amount as total_amount', 'loanschedules.paid_amount as paid_amount'
                        , 'loanschedules.paid_date as paid_date')
                ->orderBy('loanpayments.receive_date', 'DESC')
                ->get();


        $data['com'] = DB::table('companies')->find(1);
        return view('reports.payment-print', $data);
    }

    public function expense() {
        $data['sh'] = 'all';
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['loans'] = [];
        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();

        return view('reports.expense', $data);
    }

    public function search_expense(Request $r) {
        $data['sh'] = $r->shop;
        $data['start'] = $r->start;
        $data['end'] = $r->end;

        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();
        $q = DB::table('loans')
                ->join('customers', 'loans.customer_id', 'customers.id')
                ->join('phone_shops', 'loans.shop_id', 'phone_shops.id')
                ->where('loans.active', 1)
                ->where('loans.release_date', '>=', $r->start)
                ->where('loans.release_date', '<=', $r->end);
        if ($r->shop != 'all') {
            $q = $q->where('loans.shop_id', $r->shop);
        }
        $data['loans'] = $q->select('loans.*', 'customers.name', 'phone_shops.name as shop_name')
                ->orderBy('loans.release_date', 'desc')
                ->get();
        return view('reports.expense', $data);
    }

    public function print_expense(Request $r) {

        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $q = DB::table('loans')
                ->join('customers', 'loans.customer_id', 'customers.id')
                ->join('phone_shops', 'loans.shop_id', 'phone_shops.id')
                ->where('loans.active', 1)
                ->where('loans.release_date', '>=', $r->start)
                ->where('loans.release_date', '<=', $r->end);
        if ($r->sid != 'all') {
            $q = $q->where('loans.shop_id', $r->sid);
        }
        $data['loans'] = $q->select('loans.*', 'customers.name', 'phone_shops.name as shop_name')
                ->orderBy('loans.release_date', 'desc')
                ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.expense-print', $data);
    }

}
