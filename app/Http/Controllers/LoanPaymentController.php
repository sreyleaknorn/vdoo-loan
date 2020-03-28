<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
	use App\Http\Controllers\Right;
	use DB;
	use Carbon\Carbon;
class LoanPaymentController extends Controller
{
    public function  __construct(){
			$this->middleware('auth');
		}
		
		public function index() {
			if(!Right::check('loanpayment', 'l')){
				return view('permissions.no');
			}
			$data['loanpayments'] = DB::table('loanpayments')
			->join('loans', 'loans.id', '=', 'loanpayments.loan_id')
			->join('customers', 'customers.id', '=', 'loans.customer_id')
			->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
			->select('loanpayments.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
			->where('loanpayments.active', 1)
			->orderBy('loanpayments.receive_date' , 'DESC')
			->paginate(config('app.row'));
            return view('loanpayments.index', $data);
		}
		
		public function print($id) {
			if(!Right::check('loanpayment', 'l')){
				return view('permissions.no');
			}
			$data['loanpayment'] = DB::table('loanpayments')
			->join('loans', 'loans.id', '=', 'loanpayments.loan_id')
			->join('customers', 'customers.id', '=', 'loans.customer_id')
			->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
			->select('loanpayments.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
			->where([['loanpayments.id' , $id]])
			->first();
			$data['com'] = DB::table('companies')
            ->where('id', 1)
            ->first();
			
            return view('loanpayments.print', $data);
		}
}
