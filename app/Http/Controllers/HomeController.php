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
            ->whereDate('create_at', date('Y-m-d'))
            ->where('active', 1)
            ->count('id');
        $data['c2'] = DB::table('customers')
            ->whereMonth('create_at', date('m'))
            ->where('active', 1)
            ->count('id');
        $data['c3'] = DB::table('customers')
            ->whereYear('create_at', date('Y'))
            ->where('active', 1)
            ->count('id');
        $data['c4'] = DB::table('customers')
            ->where('active', 1)
            ->count('id');
        $data['p1'] = DB::table('payments')
            ->where('pay_date', date('Y-m-d'))
            ->sum('amount');
        $data['p2'] = DB::table('payments')
            ->whereMonth('pay_date', date('m'))
            ->sum('amount');
        $data['p3'] = DB::table('payments')
            ->whereYear('pay_date', date('Y'))
            ->sum('amount');
        $data['p4'] = DB::table('payments')
            ->sum('amount');
        $data['invoices'] = DB::table('invoices')
            ->join('customers', 'invoices.customer_id', 'customers.id')
            ->where('invoices.due_amount', '>', 0)
            ->orderBy('invoices.due_date', 'asc')
            ->select('invoices.*', 'customers.company_name')
            ->paginate(3);
        return view('dashboard', $data);
    }
}
