<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
	use DB;
	use Carbon\Carbon;
	
	class LoanController extends Controller
	{
		public function  __construct(){
			$this->middleware('auth');
		}
		public function index() {
			if(!Right::check('loan', 'l')){
				return view('permissions.no');
			}
			$data['loans'] = DB::table('loans')
			->join('customers', 'customers.id', '=', 'loans.customer_id')
			->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
			->select('loans.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name')
			->where('loans.active', 1)
			->paginate(config('app.row'));
            return view('loans.index', $data);
		}
		public function create(){
			if(!Right::check('loan', 'i')){
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
			return view("loans.create" , $data);
		}
		
		public function save(Request $request){
			if(!Right::check('Loan', 'i')){
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
			
			$schedule_amount = $request->loan_amount/$request->num_repayment;
			$total_interest  =(($request->loan_amount*$request->loan_interest)/100)*$request->num_repayment;
			$schedule_interest = $total_interest/$request->num_repayment;
			
			$total_amount  = $total_interest+$request->loan_amount;
			
			$data = array(
            'customer_id' => $request->customer_id,
            'shop_id' => $request->shop_id,
            'model_name' => $request->model_name,
            'serial' => $request->serial,
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
			
			
			if($request->num_repayment > 0){
				for ($i = 0; $i < $request->num_repayment ; $i++){
					$timestamp = strtotime($request->start_interest_date);
					$start_interest_date= date("d-m-Y", $timestamp);
					$schedule_date = $this->GenerateDateSchedule($start_interest_date , $request->repayment_type , $i+1 );
					$array_shcedule = array(
                    'loan_id' => $loan_id,
                    'pay_date' => $schedule_date,
                    'principal_amount' => $schedule_amount,
                    'interest_amount' => $schedule_interest,
                    'total_amount' => $schedule_interest+$schedule_amount,
                    'due_amount' => $schedule_interest+$schedule_amount
					);
					DB::table('loanschedules')->insertGetId($array_shcedule);
					
				}
			}
			return redirect('/loan');
		}
		
		public function detail($id){
			if(!Right::check('loan', 'l')){
				return view('permissions.no');
			}
			$data['loan'] = DB::table('loans')
			->join('customers', 'customers.id', '=', 'loans.customer_id')
			->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
			->select('loans.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name')
			->where([['loans.active', 1],['loans.id',$id]])
			->first();
			$data['loanschedules'] = DB::table('loanschedules')
			->where([['active',1], ['loan_id' , $id]])
			->get();
			return view('loans.detail', $data);
			
		}
		
		public function pay($id){
			if(!Right::check('loan', 'l')){
				return view('permissions.no');
			}
			
			$data['schedules'] = DB::table('loanschedules')
			->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
			->select('loanschedules.*' , 'loans.customer_id')
			->where('loanschedules.id' , $id)
			->first();
			return view('loans.pay', $data);
			
		}
		
		public function save_payment(Request $request){
			if(!Right::check('loan', 'l')){
				return view('permissions.no');
			}
			
			$validate = $request->validate([
            'customer_id' => 'required',
            'loan_id' => 'required',
            'loanschedule_id' => 'required',
            'receive_amount' => 'required'
			]);
			if($request->receive_amount == 0){
				$request->session()->flash('success', 'ចំនួនទទួលបានត្រូវតែធំជាង ០ !');
				return redirect('/loan/detail/'.$request->loan_id);
			}
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
			if($new_due_amount > 0){
				$ispaid = 0;
				$paid_date = null;
				}else {
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
			->where('id' , $request->loan_id)
			->first();
			
			
			$paid_amount = $loandata->paid_amount + $request->receive_amount;
            $due_amount = $loandata->total_amount - $paid_amount;
			if($due_amount <= 0 ||  $due_amount < 0.01){
				$status = 'paid';
				$paid_date = $request->receive_date;
			}else {
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
            ->where('id', $request->loan_id)
            ->update($data_loan);
			$request->session()->flash('success', 'ប្រាក់បានបង់ដោយជោគជ័យ !');
			return redirect('/loan/detail/'.$request->loan_id);
		}
		
		public function print($id){
			if(!Right::check('loan', 'l')){
				return view('permissions.no');
			}
			$data['loan'] = DB::table('loans')
			->join('customers', 'customers.id', '=', 'loans.customer_id')
			->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
			->select('loans.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name')
			->where([['loans.active', 1],['loans.id',$id]])
			->first();
			$data['loanschedules'] = DB::table('loanschedules')
			->where([['active',1], ['loan_id' , $id]])
			->get();
			$data['com'] = DB::table('companies')
            ->where('id', 1)
            ->first();
			return view('loans.print', $data);
			
		}
		
		public function delete(Request $r)
		{
			if(!Right::check('loan', 'd')){
				return view('permissions.no');
			}
			DB::table('loans')
            ->where('id', $r->id)
            ->update(['active'=>0]);
			DB::table('loanschedules')
            ->where('loan_id', $r->id)
            ->update(['active'=>0]);
			DB::table('loanpayments')
            ->where('loan_id', $r->id)
            ->update(['active'=>0]);
			$r->session()->flash('success', 'ទិន្នន័យត្រូវបានលុប!');
			return redirect('loan');
		}
		
		public function GenerateDateSchedule($startdate , $types , $sequence)
		{
			$date = '';
			switch ($types) {
				case "Day":
                $date = Carbon::parse($startdate)->addDays($sequence)->format('Y-m-d');
				break;
				case "Week":
                $date = Carbon::parse($startdate)->addDays(($sequence*7))->format('Y-m-d');
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
