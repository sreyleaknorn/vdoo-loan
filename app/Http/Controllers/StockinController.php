<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class StockinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
   public function index()
   {
        if(!Right::check('stock_in', 'l')){
            return view('permissions.no');
        }
        $data['q'] = '';
        $data['ins'] = DB::table('stock_ins')
            ->join('users', 'stock_ins.in_by', 'users.id')
            ->orderBy('stock_ins.in_date', 'desc')
            ->select('stock_ins.*', 'users.first_name','users.last_name')
            ->paginate(config('app.row'));
        return view('ins.index', $data);
   }
   public function search(Request $r)
   {
        if(!Right::check('stock_in', 'l')){
            return view('permissions.no');
        }
        $data['q'] = $r->q;
        $data['ins'] = DB::table('stock_ins')
            ->join('users', 'stock_ins.in_by', 'users.id')
            ->where('stock_ins.reference', 'like', "%{$r->q}%")
            ->orWhere('stock_ins.description', 'like', "%{$r->q}%")
            ->orderBy('stock_ins.in_date', 'desc')
            ->select('stock_ins.*', 'users.first_name','users.last_name')
            ->paginate(config('app.row'));
        return view('ins.index', $data);
   }
   public function create()
   {
        if(!Right::check('stock_in', 'i')){
            return view('permissions.no');
        }
       
        $data['products'] = DB::table('products')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1)
            ->select('products.*', 'units.name as uname')
            ->get();
        $data['pcats'] = DB::table('categories')
            ->where('active', 1)
            ->get();
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->get();
        return view('ins.create', $data);
   }
   public function save(Request $r)
   {
       if(!Right::check('stock_in', 'i')){
           return 0;
       }

       
       $m = json_encode($r->stock_in);
       $m = json_decode($m);
        
       
       $data = array(
           'in_date' => $m->date_in,
           'in_by' => Auth::user()->id,
           'description' => $m->description,
           'reference' => $m->reference
       );
       
       $i = DB::table('stock_ins')->insertGetId($data);
       
       if($i)
       {
           $items = json_encode($r->items);
           $items = json_decode($items);
            
           foreach($items as $item)
           {
               $data1 = array(
                   'stock_in_id' => $i,
                   'product_id' => $item->product_id,
                   'quantity' => $item->qty,
                   'in_by' => Auth::user()->id,
                   'create_at' => date('Y-m-d H:i:s'),
                   'in_date' => $m->date_in
               );

               $x = DB::table('stock_in_details')->insert($data1);
               if($x)
               {
                    // update on hand in product table
                    DB::table('products')->where('id', $item->product_id)
                        ->increment('onhand', $item->qty);
               }
           }
           return $i;
           
       }
       else{
           return 0;
       }
       
   }
   public function detail($id)
   {
        if(!Right::check('stock_in', 'l'))
        {
            return view('permissions.no');
        }
       
        $data['in'] = DB::table('stock_ins')
            ->leftJoin('users', 'stock_ins.in_by', 'users.id')
            ->where('stock_ins.id', $id)
            ->select('stock_ins.*', 'users.first_name','users.last_name')
            ->first();

        $data['details'] = DB::table('stock_in_details')
            ->join('products', 'stock_in_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('stock_in_details.stock_in_id', $id)
            ->select('stock_in_details.*', 'products.name', 'products.kh_name', 'products.code', 'units.name as uname')
            ->get();
        $data['products'] = DB::table('products')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1)
            ->select('products.*', 'units.name as uname')
            ->get();
        
        return view('ins.detail', $data);
   }
   public function save_master(Request $r)
   {
        if(!Right::check('stock_in', 'u')){
            return 0;
        }
        $data = array(
            'in_date' => $r->in_date,
            'description' => $r->description,
            'reference' => $r->reference
           
        );
        $i = DB::table('stock_ins')
            ->where('id', $r->id)
            ->update($data);
        return $r->id;
   }
   public function delete_detail($id)
   {
        if(!Right::check('stock_in', 'd')){
            return 0;
        }
       $detail = DB::table('stock_in_details')->find($id);
       $i = DB::table('stock_in_details')
            ->where('id', $id)
            ->delete();
        if($i)
        {
            
            DB::table('products')
                ->where('id', $detail->product_id)
                ->decrement('onhand', $detail->quantity);
        }
        return $i;
   }
   public function save_item(Request $r)
   {
        if(!Right::check('stock_in', 'i')){
            return 0;
        }
        $data = array(
            'stock_in_id' => $r->in_id,
            'product_id' => $r->product_id,
            'quantity' => $r->quantity,
            'in_by' => Auth::user()->id,
            'in_date' => $r->in_date
        );
        $id = DB::table('stock_in_details')
            ->insertGetId($data);
        
        if($id>0)
        {
            // update on hand in product table
            DB::table('products')->where('id', $r->product_id)
                ->increment('onhand', $r->quantity);
        }
        return $id;
   }
   public function delete($id)
   {
        if(!Right::check('stock_in', 'd')){
            return 0;
        }
        $in = DB::table('stock_ins')->find($id);
        $items = DB::table('stock_in_details')
            ->where('stock_in_id', $id)
            ->get();

        $i = DB::table('stock_ins')
            ->where('id', $id)
            ->delete();

        if($i)
        {
            DB::table('stock_in_details')
                ->where('stock_in_id', $id)
                ->delete();
            // update onhand
            foreach($items as $item)
            {
                DB::table('products')->where('id', $item->product_id)
                    ->decrement('onhand', $item->quantity);
            }
        }
        return redirect('in')->with('success', 'Data has been removed!');
   }
   public function in_print($id)
   {
        if(!Right::check('stock_in', 'l')){
            return view('permissions.no');
        }

        $data['in'] = DB::table('stock_ins')
            ->leftJoin('users', 'stock_ins.in_by', 'users.id')
           
            ->where('stock_ins.id', $id)
            ->select('stock_ins.*', 'users.first_name','users.last_name')
            ->first();

        $data['details'] = DB::table('stock_in_details')
            ->join('products', 'stock_in_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('stock_in_details.stock_in_id', $id)
            ->select('stock_in_details.*', 'products.name', 'products.code', 'products.kh_name', 'units.name as uname')
            ->get();
        $data['com'] = DB::table('companies')
            ->where('id', 1)
            ->first();
        return view('ins.print', $data);
    
    }
}
