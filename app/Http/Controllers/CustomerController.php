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
            'company_name' => $r->first_name,
            'full_name' => $r->last_name,
            'gender' => $r->gender,
            'address' => $r->address,
            'email' => $r->email,
            'phone' => $r->phone,
            'en_name' => $r->en_name,
            'en_address' => $r->en_address,
            'vatin' => $r->vatin,
            'vat' => $r->vat,
            'create_at' => date('Y-m-d H:i:s'),
            'payment_term' => $r->condition
        );
        if($r->photo) 
        { 
            $data['photo'] = $r->file('photo')->store('uploads/customers', 'custom'); 
        }

        $i = DB::table('customers')->insertGetId($data);
        if($i){
            // insert all product to customer_products
            $pros = DB::table('products')
                ->where('active', 1)
                ->get();
            foreach($pros as $p)
            {
                $data = array(
                    'customer_id' => $i,
                    'product_id' => $p->id,
                    'price' => $p->price
                );
                DB::table('customer_products')->insert($data);
            }
            $r->session()->flash('success', 'Data has been saved!');
            return redirect('customer/detail/'.$i);
        }
        else{
            $r->session()->flash('error', 'Fail to save data!');
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
            'company_name' => $r->first_name,
            'en_name' => $r->en_name,
            'full_name' => $r->last_name,
            'gender' => $r->gender,
            'address' => $r->address,
            'en_address' => $r->en_address,
            'email' => $r->email,
            'phone' => $r->phone,
            'vatin' => $r->vatin,
            'vat' => $r->vat,
            'payment_term' => $r->condition
        );
        if($r->photo) 
        { 
            $data['photo'] = $r->file('photo')->store('uploads/customers', 'custom'); 
        }
        
        $i = DB::table('customers')
            ->where('id', $r->id)
            ->update($data);
        if($i){
            $r->session()->flash('success', 'Data has been saved!');
            return redirect('customer/edit/'.$r->id);
        }
        else{
            $r->session()->flash('eror', 'Fail to save data!');
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

    public function detail($id)
    {
        if(!Right::check('customer', 'l')){
            return view(':permissions.no');
        }
        $data['cus'] = DB::table('customers')->find($id);
        $data['products'] = DB::table('customer_products')
            ->join('products', 'customer_products.product_id', 'products.id')
            ->where('customer_products.customer_id', $id)
            ->where('products.active', 1)
            ->select('customer_products.*', 'products.code', 'products.name', 'products.kh_name', 
                'products.barcode')
            ->get();
         return view('customers.detail', $data);
    }

    public function save1(Request $r)
    {

        $data = array(
            'company_name' => $r->company,
            'full_name' => $r->full_name,
            'address' => $r->address,
            'email' => $r->email,
            'phone' => $r->phone,
            'type' => 'customer'
        );
       
        $i = DB::table('customers')->insertGetId($data);

        $customer = DB::table('customers')
            ->where('id', $i)
            ->first();
        return json_encode($customer); 
    }
    public function update_price(Request $r)
    {
        
        $id = $r->id;
        DB::table('customer_products')
            ->where('id', $id)
            ->update(['price'=>$r->price]);
        return 1;
    }
}
