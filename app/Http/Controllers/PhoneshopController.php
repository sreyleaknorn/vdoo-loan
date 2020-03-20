<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PhoneshopController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index() {
        if(!Right::check('phone_shop', 'l')){
            return view('permissions.no');
        }
        $data['phone_shops'] = DB::table('phone_shops')
                ->where('active', 1)
                ->paginate(config('app.row'));
            return view('phone_shops.index', $data);
    }
	public function create(){
        if(!Right::check('phone_shop', 'i')){
            return view('permissions.no');
        }
        return view("phone_shops.create");
    }
	public function save(Request $r) {

        if(!Right::check('phone_shop', 'i')){
            return view('invoicing::permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'phone' => $r->phone,
            'address' => $r->address,
            'create_at' => date('Y-m-d H:i:s')
        );
        
        $i = DB::table('phone_shops')->insertGetId($data);
        if($i){
            return redirect('phoneshop/');
        }
        else{
            $r->session()->flash('error', 'មិនអាចរក្សាទុកទិន្នន័យ !');
            return redirect('phoneshop/create/')->withInput();
        }    
    }
	public function edit($id)
    {
        if(!Right::check('phone_shop', 'u')){
            return view('permissions.no');
        }
        $data['ps'] = DB::table('phone_shops')->find($id);
         return view('phone_shops.edit', $data);
    }
	public function update(Request $r) {
        if(!Right::check('phone_shop', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'phone' => $r->phone,
            'address' => $r->address,
        );
        
        
        $i = DB::table('phone_shops')
            ->where('id', $r->id)
            ->update($data);
        if($i){
            $r->session()->flash('success', 'ទិន្នន័យត្រូវបានរក្សាទុក');
            return redirect('phoneshop/edit/'.$r->id);
        }
        else{
            $r->session()->flash('eror', 'មិនអាចរក្សាទុកទិន្នន័យ!');
            return redirect('phoneshop/edit/'.$r->id);
        }
    }
	public function delete(Request $r)
    {
        if(!Right::check('phone_shop', 'd')){
            return view('permissions.no');
        }
        DB::table('phone_shops')
            ->where('id', $r->id)
            ->update(['active'=>0]);
        $r->session()->flash('success', 'ទិន្នន័យត្រូវបានលុប!');
        return redirect('phoneshop');
    }
	
	// add customer ajax 
    public function add_shop(Request $r){
        if(!Right::check('phone_shop', 'i')){
            return view('permissions.no');
        }
        $validate = $r->validate([
            'name' => 'required|min:2|max:100'
        ]);
        
        $data = array(
            'name' => $r->name,
            'phone' => $r->phone,
            'address' => $r->address,
            'create_at' => date('Y-m-d H:i:s')
        );
        
        
        $i = DB::table('phone_shops')->insertGetId($data);
        
        echo '<option value="'.$i.'" selected>'.$r->name.'</option>';

    }

}
