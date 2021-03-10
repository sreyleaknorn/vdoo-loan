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

    public function fast($id) {
        if (!Right::check('loanpayment', 'i')) {
            return view('permissions.no');
        }
        $sc = DB::table('loanschedules')
                ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
                ->where('loanschedules.id', $id)
                ->select('loanschedules.*', 'loans.customer_id')
                ->first();
        $receive_amount = $sc->due_amount;
        $paid_date = date('Y-m-d');

        /// add to loanpayments table
        $data_payment = array(
            'customer_id' => $sc->customer_id,
            'loan_id' => $sc->loan_id,
            'loanschedule_id' => $id,
            'receive_amount' => $receive_amount,
            'receive_date' => $paid_date
        );
        DB::table('loanpayments')->insertGetId($data_payment);
        
        /// update schedule
            $paid_amount = $sc->paid_amount;
            $new_paid_amount = $paid_amount + $receive_amount;
            $due_amount = $sc->due_amount;
            $new_due_amount = $due_amount - $receive_amount;
            if ($new_due_amount > 0) {
                $ispaid = 0;
                $paid_date = null;
            } else {
                $ispaid = 1;
                $paid_date = $paid_date;
            }
            $data_schedule = array(
                'due_amount' => $new_due_amount,
                'paid_amount' => $new_paid_amount,
                'paid_date' => $paid_date,
                'ispaid' => $ispaid
            );
            DB::table('loanschedules')
                    ->where('id', $id)
                    ->update($data_schedule);

            /// update loan
            $loandata = DB::table('loans')
                    ->where('id', $sc->loan_id)
                    ->first();

            $paid_amount = $loandata->paid_amount + $receive_amount;
            $due_amount = $loandata->total_amount - $paid_amount;

            if ($due_amount <= 0 || $due_amount < 0.01) {
                if($due_amount < 0.01){
                    $due_amount = 0;
                }
                $status = 'paid';
                $paid_date = $paid_date;
            } else {
                $status = 'paying';
                $paid_date = null;
            }

            $data_loan = array(
                'due_amount' => $due_amount,
                'paid_amount' => $paid_amount,
                'paid_date' => $paid_date,
                'status' => $status
            );
            
            DB::table('loans')
                ->where('id', $sc->loan_id)
                ->update($data_loan);

        return redirect()->back();
    }

}
