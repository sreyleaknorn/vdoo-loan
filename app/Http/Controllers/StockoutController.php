<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class StockoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
   public function index()
   {
        if(!Right::check('stock_out', 'l')){
            return view('permissions.no');
        }
        $data['q'] = '';
        $data['outs'] = DB::table('stock_outs')
            ->join('users', 'stock_outs.out_by', 'users.id')
            ->orderBy('stock_outs.out_date', 'desc')
            ->select('stock_outs.*', 'users.first_name','users.last_name')
            ->paginate(config('app.row'));
        return view('outs.index', $data);
   }
   public function search(Request $r)
   {
        if(!Right::check('stock_out', 'l')){
            return view('permissions.no');
        }
        $data['q'] = $r->q;
        $data['outs'] = DB::table('stock_outs')
            ->join('users', 'stock_outs.out_by', 'users.id')
            ->where('stock_outs.reference', 'like', "%{$r->q}%")
            ->orWhere('stock_outs.description', 'like', "%{$r->q}%")
            ->orderBy('stock_outs.out_date', 'desc')
            ->select('stock_outs.*', 'users.first_name','users.last_name')
            ->paginate(config('app.row'));
        return view('outs.index', $data);
   }
   public function create()
   {
        if(!Right::check('stock_out', 'i')){
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
        return view('outs.create', $data);
   }
   public function save(Request $r)
   {
       if(!Right::check('stock_out', 'i')){
           return 0;
       }

       
       $m = json_encode($r->stock_out);
       $m = json_decode($m);
        
       
       $data = array(
           'out_date' => $m->date_out,
           'out_by' => Auth::user()->id,
           'description' => $m->description,
           'reference' => $m->reference
       );
       
       $i = DB::table('stock_outs')->insertGetId($data);
       
       if($i)
       {
           $items = json_encode($r->items);
           $items = json_decode($items);
            
           foreach($items as $item)
           {
               $data1 = array(
                   'stock_out_id' => $i,
                   'product_id' => $item->product_id,
                   'quantity' => $item->qty,
                   'out_by' => Auth::user()->id,
                   'create_at' => date('Y-m-d H:i:s'),
                   'out_date' => $m->date_out
               );

               $x = DB::table('stock_out_details')->insert($data1);
               if($x)
               {
                    // update on hand in product table
                    DB::table('products')->where('id', $item->product_id)
                        ->decrement('onhand', $item->qty);
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
        if(!Right::check('stock_out', 'l'))
        {
            return view('permissions.no');
        }
       
        $data['out'] = DB::table('stock_outs')
            ->leftJoin('users', 'stock_outs.out_by', 'users.id')
            ->where('stock_outs.id', $id)
            ->select('stock_outs.*', 'users.first_name','users.last_name')
            ->first();

        $data['details'] = DB::table('stock_out_details')
            ->join('products', 'stock_out_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('stock_out_details.stock_out_id', $id)
            ->select('stock_out_details.*', 'products.name', 'products.kh_name', 'products.code', 'units.name as uname')
            ->get();
        $data['products'] = DB::table('products')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1)
            ->select('products.*', 'units.name as uname')
            ->get();
        
        return view('outs.detail', $data);
   }
   public function save_master(Request $r)
   {
        if(!Right::check('stock_out', 'u')){
            return 0;
        }
        $data = array(
            'out_date' => $r->out_date,
            'description' => $r->description,
            'reference' => $r->reference
           
        );
        $i = DB::table('stock_outs')
            ->where('id', $r->id)
            ->update($data);
        return $r->id;
   }

   public function delete_detail($id)
   {
        if(!Right::check('stock_out', 'd')){
            return 0;
        }
       $detail = DB::table('stock_out_details')->find($id);
       $i = DB::table('stock_out_details')
            ->where('id', $id)
            ->delete();
        if($i)
        {
            
            DB::table('products')
                ->where('id', $detail->product_id)
                ->increment('onhand', $detail->quantity);
        }
        return $i;
   }
   public function save_item(Request $r)
   {
        if(!Right::check('stock_out', 'i')){
            return 0;
        }
        $data = array(
            'stock_out_id' => $r->out_id,
            'product_id' => $r->product_id,
            'quantity' => $r->quantity,
            'out_by' => Auth::user()->id,
            'out_date' => $r->out_date
        );
        $id = DB::table('stock_out_details')
            ->insertGetId($data);
        
        if($id>0)
        {
            // update on hand in product table
            DB::table('products')->where('id', $r->product_id)
                ->decrement('onhand', $r->quantity);
        }
        return $id;
   }
   public function delete($id)
   {
        if(!Right::check('stock_out', 'd')){
            return 0;
        }
        $in = DB::table('stock_outs')->find($id);
        $items = DB::table('stock_out_details')
            ->where('stock_out_id', $id)
            ->get();

        $i = DB::table('stock_outs')
            ->where('id', $id)
            ->delete();

        if($i)
        {
            DB::table('stock_out_details')
                ->where('stock_out_id', $id)
                ->delete();
            // update onhand
            foreach($items as $item)
            {
                DB::table('products')->where('id', $item->product_id)
                    ->increment('onhand', $item->quantity);
            }
        }
        return redirect('out')->with('success', 'Data has been removed!');
   }
   public function print($id)
   {
        if(!Right::check('stock_out', 'l')){
            return view('permissions.no');
        }

        $data['out'] = DB::table('stock_outs')
            ->leftJoin('users', 'stock_outs.out_by', 'users.id')
           
            ->where('stock_outs.id', $id)
            ->select('stock_outs.*', 'users.first_name','users.last_name')
            ->first();

        $data['details'] = DB::table('stock_out_details')
            ->join('products', 'stock_out_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('stock_out_details.stock_out_id', $id)
            ->select('stock_out_details.*', 'products.name', 'products.code', 'products.kh_name', 'units.name as uname')
            ->get();
        $data['com'] = DB::table('companies')
            ->where('id', 1)
            ->first();
        return view('outs.print', $data);
    
    }
}
