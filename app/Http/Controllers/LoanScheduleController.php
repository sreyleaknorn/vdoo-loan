<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Illuminate\Routing\Controller;
	use App\Http\Controllers\Right;
	use DB;
	use Carbon\Carbon;
	
	class LoanScheduleController extends Controller
	{
		public function  __construct(){
			$this->middleware('auth');
		}
		
		public function index() {
			if(!Right::check('loanschedule', 'l')){
				return view('permissions.no');
			}
			$data['loanschedules'] = DB::table('loanschedules')
			->join('loans', 'loans.id', '=', 'loanschedules.loan_id')
			->join('customers', 'customers.id', '=', 'loans.customer_id')
			->join('phone_shops', 'phone_shops.id', '=', 'loans.shop_id')
			->select('loanschedules.*', 'customers.name', 'customers.phone' , 'phone_shops.name as shop_name' )
			->where('loanschedules.active', 1)
			->orderBy('loanschedules.pay_date' , 'ASC')
			->paginate(config('app.row'));
            return view('loanschedules.index', $data);
		}
	}