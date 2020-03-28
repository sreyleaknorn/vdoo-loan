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
        return view('dashboard', $data);
    }
}
