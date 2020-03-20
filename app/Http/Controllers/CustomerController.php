<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CustomerController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index() {
        if(!Right::check('customer', 'l')){
            return view('permissions.no');
        }
        $data['customers'] = DB::table('customers')
                ->where('active', 1)
                ->paginate(config('app.row'));
            return view('customers.index', $data);
    }

    public function create(){
        if(!Right::check('customer', 'i')){
            return view('permissions.no');
        }
        return view("customers.create");
    }

    public function save(Request $r) {

        if(!Right::check('customer', 'i')){
            return view('invoicing::permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'phone' => $r->phone,
            'create_at' => date('Y-m-d H:i:s')
        );
        
        $i = DB::table('customers')->insertGetId($data);
        if($i){
            return redirect('customer/');
        }
        else{
            $r->session()->flash('error', 'មិនអាចរក្សាទុកទិន្នន័យ!');
            return redirect('customer/create/')->withInput();
        }    
    }
    public function edit($id)
    {
        if(!Right::check('customer', 'u')){
            return view('permissions.no');
        }
        $data['cus'] = DB::table('customers')->find($id);
         return view('customers.edit', $data);
    }
 
    public function update(Request $r) {
        if(!Right::check('customer', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'phone' => $r->phone,
        );
        
        
        $i = DB::table('customers')
            ->where('id', $r->id)
            ->update($data);
        if($i){
            $r->session()->flash('success', 'ទិន្នន័យត្រូវបានរក្សាទុក');
            return redirect('customer/edit/'.$r->id);
        }
        else{
            $r->session()->flash('eror', 'មិនអាចរក្សាទុកទិន្នន័យ!');
            return redirect('customer/edit/'.$r->id);
        }
    }
    public function delete(Request $r)
    {
        if(!Right::check('customer', 'd')){
            return view('permissions.no');
        }
        DB::table('customers')
            ->where('id', $r->id)
            ->update(['active'=>0]);
        $r->session()->flash('success', 'Data has been removed!');
        return redirect('customer');
    }

	// add customer ajax 
    public function add_customer(Request $r){
        if(!Right::check('customer', 'i')){
            return view('permissions.no');
        }
        $validate = $r->validate([
            'name' => 'required|min:2|max:100'
        ]);
        
        $data = array(
            'name' => $r->name,
            'phone' => $r->phone,
			'create_at' => date('Y-m-d H:i:s')
        );
        
        $i = DB::table('customers')->insertGetId($data);
        
        echo '<option value="'.$i.'" selected>'.$r->name.'</option>';

    }
       
}
