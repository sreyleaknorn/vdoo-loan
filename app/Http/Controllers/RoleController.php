<?php

namespace App\Http\Controllers;
use Auth;
use DB;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }
    public function index(){
        if(!Right::check('Role', 'l')){
            return view('permissions.no');
        }
        $data['roles'] = DB::table('roles')
                        ->where("active",1)
                        ->paginate(18);
        return view('roles.index',$data);
    }
    public function create(){
        if(!Right::check('Role', 'i')){
            return view('permissions.no');
        }
        return view('roles.create');
    }
    public function save(Request $r){
        if(!Right::check('Role', 'i')){
            return view('permissions.no');
        }
        $data = array(
            "name" => $r->name
        );
        $i = DB::table('roles')->insert($data);
        if($i){
            return redirect('role/create')
                ->with('success', 'Data has been saved!');
        }
        else {
            return redirect('role/create')
                ->with('error', 'Fail to save data!')
                ->withInput();
        }
    }
    public function edit($id){
        if(!Right::check('Role', 'u')){
            return view('permissions.no');
        }
    	$data['roles'] = DB::table("roles")->where("id",$id)->first();
    	return view("roles.edit",$data);
    }
    public function update(Request $r){
        if(!Right::check('Role', 'u')){
            return view('permissions.no');
        }
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("roles")->where("id", $r->id)->update($data);
        if ($i)
        {
            return redirect("/role/edit/". $r->id)
                ->with('success', 'Data has been saved!');
        }
        else{
            return redirect("/role/edit/". $r->id)
                ->with('error', 'Fail to save data!');
        }
    }
    public function delete($id)
    {
        if(!Right::check('Role', 'd')){
            return view('permissions.no');
        }
        DB::table('roles')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/role?page='.$page)
                ->with('success', 'Data has been removed!');
        }
        return redirect('/role')
        ->with('success', 'Data has been removed!');
    }
}
