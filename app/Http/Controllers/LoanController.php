<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;
use Carbon\Carbon;

class LoanController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (!Right::check('loan', 'l')) {
            return view('permissions.no');
        }
        $data['loans'] = DB::table('loans')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loans.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where('loans.active', 1)
                ->orderBy('loans.id', 'DESC')
                ->paginate(config('app.row'));
        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();
        $data['sh'] = 'all';
        $data['cus'] = '';
        $data['status'] = 'all';
        return view('loans.index', $data);
    }
    
    public function search(Request $r) {
        if (!Right::check('loan', 'l')) {
            return view('permissions.no');
        }
        $q = DB::table('loans')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->where('loans.active', 1);
        if ($r->shop != 'all') {
            $q = $q->where('phone_shops.id', $r->shop);
        }  
        if ($r->status != 'all') {
            $q = $q->where('loans.status', $r->status);
        }     
        $cus = $r->cus;
        if($r->cus != ''){
            $q = $q->where(function($query) use ($cus){
                $query = $query->orWhere('customers.name', 'like', "%{$cus}%")
                    ->orWhere('customers.phone', 'like', "%{$cus}%");
            });
        }
        $data['loans'] = $q->select('loans.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->orderBy('loans.id', 'DESC')
                ->paginate(config('app.row'));
        $data['shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->get();
        $data['sh'] = $r->shop;
        $data['cus'] = $r->cus;
        $data['status'] = $r->status;
        return view('loans.index', $data);
    }

    public function create() {
        if (!Right::check('loan', 'i')) {
            return view('permissions.no');
        }
        $data['customers'] = DB::table('customers')
                ->where('active', 1)
                ->orderBy('name')
                ->get();
        $data['phone_shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->orderBy('name')
                ->get();
        return view("loans.create", $data);
    }

    public function save(Request $request) {
        if (!Right::check('loan', 'i')) {
            return view('permissions.no');
        }
        $validate = $request->validate([
            'customer_id' => 'required',
            'shop_id' => 'required',
            'loan_date' => 'required',
            'loan_amount' => 'required',
            'loan_interest' => 'required',
            'num_repayment' => 'required'
        ]);
        $num_repayment = $request->num_repayment;
        $repayment_type = $request->repayment_type;

        $schedule_amount = $request->loan_amount / $request->num_repayment;
        $total_interest = (($request->loan_amount * $request->loan_interest) / 100) * $request->num_repayment;
        $schedule_interest = $total_interest / $request->num_repayment;

        $total_amount = $total_interest + $request->loan_amount;

        $data = array(
            'customer_id' => $request->customer_id,
            'shop_id' => $request->shop_id,
            'model_name' => $request->model_name,
            'serial' => $request->serial,
            'bill_no' => $request->bill_no,
            'loan_amount' => $request->loan_amount,
            'loan_interest' => $request->loan_interest,
            'loan_date' => $request->loan_date,
            'release_date' => $request->release_date,
            'num_repayment' => $request->num_repayment,
            'repayment_type' => $request->repayment_type,
            'start_interest_date' => $request->start_interest_date,
            'note' => $request->note,
            'total_interest' => $total_interest,
            'total_amount' => $total_amount,
            'due_amount' => $total_amount
        );

        $loan_id = DB::table('loans')->insertGetId($data);


        if ($request->num_repayment > 0) {
            for ($i = 0; $i < $request->num_repayment; $i++) {
                $timestamp = strtotime($request->start_interest_date);
                $start_interest_date = date("d-m-Y", $timestamp);
                $schedule_date = $this->GenerateDateSchedule($start_interest_date, $request->repayment_type, $i + 1);
                $array_shcedule = array(
                    'loan_id' => $loan_id,
                    'pay_date' => $schedule_date,
                    'principal_amount' => $schedule_amount,
                    'interest_amount' => $schedule_interest,
                    'total_amount' => $schedule_interest + $schedule_amount,
                    'due_amount' => $schedule_interest + $schedule_amount
                );
                DB::table('loanschedules')->insertGetId($array_shcedule);
            }
        }
        return redirect('/loan');
    }

    public function edit($id) {
        if (!Right::check('loan', 'u')) {
            return view('permissions.no');
        }
        $data['loan'] = DB::table('loans')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loans.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loans.active', 1], ['loans.id', $id]])
                ->first();
        $data['customers'] = DB::table('customers')
                ->where('active', 1)
                ->orderBy('name')
                ->get();
        $data['phone_shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->orderBy('name')
                ->get();

        return view('loans.edit', $data);
    }

    public function update(Request $request) {
        if (!Right::check('loan', 'u')) {
            return view('permissions.no');
        }
        $validate = $request->validate([
            'customer_id' => 'required',
            'shop_id' => 'required',
            'loan_date' => 'required',
            'loan_amount' => 'required',
            'loan_interest' => 'required',
            'num_repayment' => 'required'
        ]);
        $loan_id = $request->id;
        $old = DB::table('loans')
        ->join('customers', 'customers.id', '=', 'loans.customer_id')
        ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
        ->select('loans.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
        ->where('loans.id', $loan_id)
        ->first();
        
        $num_repayment = $request->num_repayment;
        $repayment_type = $request->repayment_type;

        $schedule_amount = $request->loan_amount / $request->num_repayment;
        $total_interest = (($request->loan_amount * $request->loan_interest) / 100) * $request->num_repayment;
        $schedule_interest = $total_interest / $request->num_repayment;

        $total_amount = $total_interest + $request->loan_amount;

        $data = array(
            'customer_id' => $request->customer_id,
            'shop_id' => $request->shop_id,
            'model_name' => $request->model_name,
            'serial' => $request->serial,
            'bill_no' => $request->bill_no,
            'loan_amount' => $request->loan_amount,
            'loan_interest' => $request->loan_interest,
            'loan_date' => $request->loan_date,
            'release_date' => $request->release_date,
            'num_repayment' => $request->num_repayment,
            'repayment_type' => $request->repayment_type,
            'start_interest_date' => $request->start_interest_date,
            'note' => $request->note,
            'total_interest' => $total_interest,
            'total_amount' => $total_amount,
            'due_amount' => $total_amount
        );

        DB::table('loans')
                ->where('id', $loan_id)
                ->update($data);


        if($request->num_repayment != $old->num_repayment || $request->loan_amount != $old->loan_amount || $request->loan_interest != $old->loan_interest || $request->repayment_type != $old->repayment_type  || $request->start_interest_date != $old->start_interest_date){
            
            DB::table('loanschedules')
                ->where('loan_id', $loan_id)
                ->update(['active' => 0]);
            /* generate new schedule */
            if ($request->num_repayment > 0) {
                for ($i = 0; $i < $request->num_repayment; $i++) {
                    $timestamp = strtotime($request->start_interest_date);
                    $start_interest_date = date("d-m-Y", $timestamp);
                    $schedule_date = $this->GenerateDateSchedule($start_interest_date, $request->repayment_type, $i + 1);
                    $array_shcedule = array(
                        'loan_id' => $loan_id,
                        'pay_date' => $schedule_date,
                        'principal_amount' => $schedule_amount,
                        'interest_amount' => $schedule_interest,
                        'total_amount' => $schedule_interest + $schedule_amount,
                        'due_amount' => $schedule_interest + $schedule_amount
                    );
                    DB::table('loanschedules')->insertGetId($array_shcedule);
                }
            }
        }
        
        return redirect('/loan/detail/'.$loan_id);
    }

    public function detail($id) {
        if (!Right::check('loan', 'l')) {
            return view('permissions.no');
        }
        $data['loan'] = DB::table('loans')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loans.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loans.active', 1], ['loans.id', $id]])
                ->first();
        $data['loanschedules'] = DB::table('loanschedules')
                ->where([['active', 1], ['loan_id', $id]])
                ->get();
        $data['loanpayments'] = DB::table('loanpayments')
                ->where([['active', 1], ['loan_id', $id]])
                ->get();
        $data['stop_payments'] = DB::table('stop_payments')
                ->where([['active', 1], ['loan_id', $id]])
                ->get();

        return view('loans.detail', $data);
    }

    public function pay($id) {
        if (!Right::check('loanpayment', 'i')) {
            return view('permissions.no');
        }
        $payment = '';
        $loan_id = 0;
        if (isset($_GET['payment']) && isset($_GET['loan_id'])) {
            $payment = 'all';
            $loan_id = $_GET['loan_id'];
        }
        $data['loanschedules'] = DB::table('loanschedules')
                ->where([['active', 1], ['loan_id', $loan_id], ['ispaid', 0]])
                ->get();

        $data['schedules'] = DB::table('loanschedules')
                ->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
                ->select('loanschedules.*', 'loans.customer_id')
                ->where('loanschedules.id', $id)
                ->first();
        return view('loans.pay', $data);
    }

    public function save_payment(Request $request) {
        if (!Right::check('loanpayment', 'i')) {
            return view('permissions.no');
        }

        $validate = $request->validate([
            'customer_id' => 'required',
            'loan_id' => 'required',
            'loanschedule_id' => 'required',
            'receive_amount' => 'required'
        ]);
        if ($request->receive_amount == 0) {
            $request->session()->flash('error', 'ចំនួនទឹកប្រាក់ដែលទទួលបានត្រូវតែធំជាង ០ !');
            return redirect('/loan/detail/' . $request->loan_id);
        }
        /* payment by schedule */
        if ($request->all_payment == 0) {
            /// add to loanpayments table
            $data_payment = array(
                'customer_id' => $request->customer_id,
                'loan_id' => $request->loan_id,
                'loanschedule_id' => $request->loanschedule_id,
                'receive_amount' => $request->receive_amount,
                'receive_date' => $request->receive_date,
                'note' => $request->note,
            );
            DB::table('loanpayments')->insertGetId($data_payment);

            /// update schedule
            $paid_amount = $request->paid_amount;
            $new_paid_amount = $paid_amount + $request->receive_amount;
            $due_amount = $request->due_amount;
            $new_due_amount = $due_amount - $request->receive_amount;
            if ($new_due_amount > 0) {
                $ispaid = 0;
                $paid_date = null;
            } else {
                $ispaid = 1;
                $paid_date = $request->receive_date;
            }
            $data_schedule = array(
                'due_amount' => $new_due_amount,
                'paid_amount' => $new_paid_amount,
                'paid_date' => $paid_date,
                'ispaid' => $ispaid
            );
            DB::table('loanschedules')
                    ->where('id', $request->loanschedule_id)
                    ->update($data_schedule);

            /// update loan
            $loandata = DB::table('loans')
                    ->where('id', $request->loan_id)
                    ->first();

            $paid_amount = $loandata->paid_amount + $request->receive_amount;
            $due_amount = $loandata->total_amount - $paid_amount;

            if ($due_amount <= 0 || $due_amount < 0.01) {
                $status = 'paid';
                $paid_date = $request->receive_date;
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
        } else {
            /* payment all */
            $receive_amount = $request->receive_amount;
            $paid_date = $request->receive_date;

            $schedule_id_arr = $request->sch_id;
            $due_amount_arr = $request->all_due_amount;
            $num_sch = count($schedule_id_arr);
            $new_sch_paid = $receive_amount / $num_sch;
            $all_paid_amount = $request->all_paid_amount;
            $i = 0;

            $receive_amount_new = $receive_amount;
            foreach ($schedule_id_arr as $schedule_id) {
                if (($receive_amount_new - $due_amount_arr[$i]) > 0) {
                    $receive_amount_new = $receive_amount_new - $due_amount_arr[$i];
                    $data_schedule = array(
                        'due_amount' => 0,
                        'paid_amount' => $all_paid_amount[$i] + $due_amount_arr[$i],
                        'paid_date' => $paid_date,
                        'ispaid' => 1
                    );
                    DB::table('loanschedules')
                            ->where('id', $schedule_id)
                            ->update($data_schedule);

                    /// add to loanpayments table
                    $data_payment = array(
                        'customer_id' => $request->customer_id,
                        'loan_id' => $request->loan_id,
                        'loanschedule_id' => $schedule_id,
                        'receive_amount' => $due_amount_arr[$i],
                        'receive_date' => $request->receive_date,
                        'note' => $request->note,
                    );
                    DB::table('loanpayments')->insertGetId($data_payment);
                } else {
                    if ($receive_amount_new > 0) {
                        $data_schedule = array(
                            'due_amount' => 0,
                            'paid_amount' => $all_paid_amount[$i] + $receive_amount_new,
                            'paid_date' => $paid_date,
                            'ispaid' => 1
                        );
                        DB::table('loanschedules')
                                ->where('id', $schedule_id)
                                ->update($data_schedule);


                        /// add to loanpayments table
                        $data_payment = array(
                            'customer_id' => $request->customer_id,
                            'loan_id' => $request->loan_id,
                            'loanschedule_id' => $schedule_id,
                            'receive_amount' => $receive_amount_new,
                            'receive_date' => $request->receive_date,
                            'note' => $request->note,
                        );
                        DB::table('loanpayments')->insertGetId($data_payment);
                        $receive_amount_new = 0;
                    } else {
                        $data_schedule = array(
                            'due_amount' => 0,
                            'paid_date' => $paid_date,
                            'ispaid' => 1
                        );
                        DB::table('loanschedules')
                                ->where('id', $schedule_id)
                                ->update($data_schedule);
                    }
                }

                $i++;
            }

            /// update loan
            $loandata = DB::table('loans')
                    ->where('id', $request->loan_id)
                    ->first();

            $paid_amount = $loandata->paid_amount + $request->receive_amount;
            $due_amount = 0;

            $status = 'paid';
            $paid_date = $request->receive_date;

            $data_loan = array(
                'due_amount' => $due_amount,
                'paid_amount' => $paid_amount,
                'paid_date' => $paid_date,
                'status' => $status
            );
        }

        DB::table('loans')
                ->where('id', $request->loan_id)
                ->update($data_loan);
        $request->session()->flash('success', 'ប្រាក់បានបង់ដោយជោគជ័យ !');


        return redirect('/loan/detail/' . $request->loan_id);
    }

    public function delete_payment(Request $r) {
        if (!Right::check('loanpayment', 'd')) {
            return view('permissions.no');
        }


        $pm = DB::table('loanpayments')
                ->where('id', $r->id)
                ->first();

        $receive_amount = $pm->receive_amount;
        $loanschedule_id = $pm->loanschedule_id;
        $loan_id = $pm->loan_id;

        /* schedule */
        $schedule = DB::table('loanschedules')
                ->where('id', $loanschedule_id)
                ->first();

        $sc_paid_amount = $schedule->paid_amount - $receive_amount;
        $sc_due_amount = $schedule->due_amount + $receive_amount;
        if ($sc_due_amount > 0) {
            $ispaid = 0;
            $paid_date = null;
        } else {
            $ispaid = 1;
            $paid_date = $schedule->paid_date;
        }
        $data_schedule = array(
            'due_amount' => $sc_due_amount,
            'paid_amount' => $sc_paid_amount,
            'paid_date' => $paid_date,
            'ispaid' => $ispaid
        );
        DB::table('loanschedules')
                ->where('id', $loanschedule_id)
                ->update($data_schedule);

        /* loan */
        $loan = DB::table('loans')
                ->where('id', $loan_id)
                ->first();

        $loan_paid_amount = $loan->paid_amount - $receive_amount;
        $loan_due_amount = $loan->due_amount + $receive_amount;
        if ($loan_due_amount <= 0 || $loan_due_amount < 0.01) {
            $status = 'paid';
            $paid_date = $loan->paid_date;
        } else {
            $status = 'paying';
            $paid_date = null;
        }

        $data_loan = array(
            'due_amount' => $loan_due_amount,
            'paid_amount' => $loan_paid_amount,
            'paid_date' => $paid_date,
            'status' => $status
        );

        DB::table('loans')
                ->where('id', $loan_id)
                ->update($data_loan);


        DB::table('loanpayments')
                ->where('id', $r->id)
                ->update(['active' => 0]);

        $r->session()->flash('error', 'ទិន្នន័យត្រូវបានលុប!');
        return redirect('/loan/detail/' . $loan_id);
        }

        public function print($id){
        if (!Right::check('loan', 'l')) {
            return view('permissions.no');
        }
        $data['loan'] = DB::table('loans')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('loans.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name')
                ->where([['loans.active', 1], ['loans.id', $id]])
                ->first();
        $data['loanschedules'] = DB::table('loanschedules')
                ->where([['active', 1], ['loan_id', $id]])
                ->get();
        $data['com'] = DB::table('companies')
                ->where('id', 1)
                ->first();
        return view('loans.print', $data);
    }

    public function save_stopped() {
        if (!Right::check('loan', 'u')) {
            return view('permissions.no');
        }
        $loan_id = $r->loan_id;
        $data = array(
            'stop_date' => $r->stop_date,
            'reason' => $r->reason,
            'loan_id' => $r->loan_id,
            'create_at' => date('Y-m-d H:i:s')
        );
        $i = DB::table('stop_payments')->insertGetId($data);
        if ($i) {
            $data_loan = array(
                'status' => 'stopped'
            );

            DB::table('loans')
                    ->where('id', $loan_id)
                    ->update($data_loan);
        }
        return redirect('/loan/detail/' . $loan_id);
    }

    public function stopped(Request $r) {
        if (!Right::check('loan', 'l')) {
            return view('permissions.no');
        }
        $data['stop_payments'] = DB::table('stop_payments')
                ->join('loans', 'loans.id', '=', 'stop_payments.loan_id')
                ->join('customers', 'customers.id', '=', 'loans.customer_id')
                ->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
                ->select('stop_payments.*', 'customers.name', 'customers.phone', 'phone_shops.name as shop_name', 'loans.loan_amount as loan_amount', 'loans.total_interest as total_interest', 'loans.paid_amount as paid_amount')
                ->where([['stop_payments.active', 1], ['loans.status', 'stopped']])
                ->orderBy('stop_payments.id', 'DESC')
                ->paginate(config('app.row'));
        return view('loans.stop', $data);
    }

    public function delete(Request $r) {
        if (!Right::check('loan', 'd')) {
            return view('permissions.no');
        }
        DB::table('loans')
                ->where('id', $r->id)
                ->update(['active' => 0]);
        DB::table('loanschedules')
                ->where('loan_id', $r->id)
                ->update(['active' => 0]);
        DB::table('loanpayments')
                ->where('loan_id', $r->id)
                ->update(['active' => 0]);
        $r->session()->flash('success', 'ទិន្នន័យត្រូវបានលុប!');
        return redirect('loan');
    }

    public function GenerateDateSchedule($startdate, $types, $sequence) {
        $date = '';
        switch ($types) {
            case "Day":
                $date = Carbon::parse($startdate)->addDays($sequence)->format('Y-m-d');
                break;
            case "Week":
                $date = Carbon::parse($startdate)->addDays(($sequence * 7))->format('Y-m-d');
                break;
            case "Month":
                $date = Carbon::parse($startdate)->addMonths($sequence)->format('Y-m-d');
                break;
            case "Year":
                $date = Carbon::parse($startdate)->addYears($sequence)->format('Y-m-d');

                break;
            default:
                $date = '';
        }
        return $date;
    }

}
