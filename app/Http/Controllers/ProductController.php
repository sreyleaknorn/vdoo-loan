<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;
use Auth;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
        if(!Right::check('product', 'l')){
            return view('permissions.no');
        }
        $data['q'] = "";
        $data['products'] = DB::table('products')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.active', 1)
            ->orderBy('products.id', 'desc')
            ->select('products.*', 'units.name as uname', 'categories.name as cname')
            ->paginate(config('app.row'));
        return view('products.index', $data);
    }
    public function search(Request $r)
    {
        if(!Right::check('product', 'l')){
            return view('permissions.no');
        }
        $data['q'] = $r->q;
        $q = $r->q;
        $data['products'] = DB::table('products')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.active', 1)
            ->where(function($query) use($q){
                $query->orWhere('products.name', 'like', "%{$q}%")
                ->orWhere('products.code','like',"%{$q}%")
                ->orWhere('products.kh_name','like',"%{$q}%")
                ->orWhere('products.barcode','like',"%{$q}%")
                ->orWhere('products.description','like',"%{$q}%");
            })
            ->orderBy('products.id', 'desc')
            ->select('products.*', 'units.name as uname', 'categories.name as cname')
            ->paginate(config('app.row'));
        return view('products.index', $data);
    }
    public function detail($id)
    {
        if(!Right::check('product', 'l')){
            return view('permissions.no');
        }
        $data['p'] = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('products.id', $id)
            ->select('products.*', 'categories.name as cname', 'units.name as uname')
            ->first();
        
        
        return view('products.detail', $data);
    }
    public function create()
    {
        if(!Right::check('product', 'i')){
            return view('permissions.no');
        }
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->get();
        $data['categories'] = DB::table('categories')
            ->where('active', 1)
            ->get();

        return view('products.create', $data);
    }

   public function save(Request $r)
   {
        if(!Right::check('product', 'i')){
            return view('inventory::permissions.no');
        }
        $r->validate([
            'name' => 'required'
        ]);
        $data = array(
            'name' => $r->name,
            'kh_name' => $r->kh_name,
            'code' => $r->code,
            'barcode' => $r->barcode,
            'price' => $r->price,
            'cost' => 0,
            'category_id' => $r->category,
            'unit_id' => $r->unit,
            'description' => $r->description,
            'begin_balance' => 0,
            'onhand' => 0,
            'actual_qty' => 0,
            'discount' => $r->discount
        );
       
        if($r->photo)
        {
            $data['photo'] = $r->file('photo')->store('uploads/products', 'custom');
        }
        $i = DB::table('products')->insertGetId($data);
        if($i){
            $customers = DB::table('customers')
                ->where('active', 1)
                ->get();
            
            foreach($customers as $c)
            {
                DB::table('customer_products')
                    ->insert([
                        'product_id' => $i,
                        'customer_id' => $c->id,
                        'price' => $r->price
                    ]);
            }
            return redirect('product/detail/'. $i);
        }
        else{
            $r->session()->flash('error', 'Fail to save data!');
            return redirect('product/create')->withInput();
        }
   }

    public function edit($id)
    {
        if(!Right::check('product', 'u')){
            return view('permissions.no');
        }
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->get();
        $data['categories'] = DB::table('categories')
            ->where('active', 1)
            ->get();
        $data['product'] = DB::table('products')->find($id);
        return view('products.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('product', 'u')){
            return view('permissions.no');
        }
        $p = DB::table('products')->where('id', $r->id)
            ->first();

        $r->validate([
            'name' => 'required'
        ]);
        $data = array(
            'name' => $r->name,
            'code' => $r->code,
            'kh_name' => $r->kh_name,
            'barcode' => $r->barcode,
            'price' => $r->price,
            'category_id' => $r->category,
            'unit_id' => $r->unit,
            'description' => $r->description,

            'discount' => $r->discount,
            'onhand' => $r->onhand,
        );

        
        if($r->photo)
        {
            $data['photo'] = $r->file('photo')->store('uploads/products', 'custom');
        }
        $i = DB::table('products')->where('id', $r->id)->update($data);
        if($i)
        {
           
            $r->session()->flash('success', 'Data has been saved!');
            return redirect('product/detail/'.$r->id);
        }
        else{
            $r->session()->flash('error', 'Fail to save data!');
            return redirect('product/edit/'.$r->id);
        }
    }
    // delete
    public function delete(Request $r)
    {
        if(!Right::check('product', 'd')){
            return view('permissions.no');
        }
        DB::table('products')
            ->where('id', $r->id)
            ->update(['active'=>0]);
        $r->session()->flash('success', 'Data has been removed!');
        return redirect('product');
    }
    public function get_unit($id) {
        
        $unit = DB::table('products')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.id', $id)
            ->select('products.*', 'units.name as uname')
            ->first();
        return $unit->uname;
    }

    public function delete_supplier(Request $r)
    {
        $pid = $r->pid;
        $sid = $r->sid;
        DB::table('product_suppliers')
            ->where('id', $sid)
            ->delete();
        return redirect('inventory/product/detail/'.$pid);
    }
    
    // save product from create stock in form
    public function save_product(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'code' => $r->code,
            'category_id' => $r->category_id,
            'unit_id' => $r->unit_id
        );
        $i = DB::table('products')->insertGetId($data);
        $pro = DB::table('products')
            ->where('id', $i)
            ->first();
        return json_encode($pro);
    }
    
    public function save_category(Request $r)
    {
        $data = array(
            'name' => $r->catname
        );
        $i = DB::table('categories')->insertGetId($data);
        $cat = DB::table('categories')->find($i);
        return json_encode($cat);
    }
    public function save_unit(Request $r)
    {
      
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('units')->insertGetId($data);
        $unit = DB::table('units')->find($i);
        return json_encode($unit);
    }
}
