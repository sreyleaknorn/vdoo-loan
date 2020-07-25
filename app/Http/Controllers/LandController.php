<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;

class LandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Right::check('land', 'l')){
            return view('setting::permissions.no');
        }
        
        return view('lands.index');
    }
	public function create()
    {
        if(!Right::check('land', 'i')){
            return view('setting::permissions.no');
        }
        return view('lands.create');
    }
}
