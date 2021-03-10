<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Right::check('project', 'l')){
            return view('setting::permissions.no');
        }
        
        return view('projects.index');
    }
	public function create()
    {
        if(!Right::check('project', 'i')){
            return view('setting::permissions.no');
        }
        
        return view('projects.create');
    }
}
