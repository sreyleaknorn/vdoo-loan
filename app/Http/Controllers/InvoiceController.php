<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Right::check('invoice', 'l')) {
            return view('permissions.no');
        }
        $data['invoices'] = DB::table('invoices')
            ->join('customers', 'invoices.customer_id', 'customers.id')
            ->orderBy('invoices.id', 'desc')
            ->select('invoices.*', 'customers.company_name', 'customers.full_name')
            ->paginate(config('app.row'));
        return view('invoices.index', $data);
    }
    
    public function create()
    {
        if(!Right::check('invoice', 'i')){
            return view('permissions.no');
        }
       
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $data['customers'] = DB::table('customers')
            ->where('type', 'customer')
            ->where('active', 1)
            ->get();
        $linv = DB::table('invoices')->orderBy('id', 'desc')->first();
        $data['inv'] = $linv?$linv->id:0;
        $data['pcats'] = DB::table('categories')
            ->where('active', 1)
            ->get();
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->get();
        $data['exc'] = DB::table('exchanges')
            ->where('active', 1)
            ->first();
        return view('invoices.create', $data);
    }
    public function get_price(Request $r, $id)
    {
        $p = DB::table('customer_products')
            ->join('products', 'customer_products.product_id', 'products.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('customer_products.product_id', $id)
            ->where('customer_products.customer_id', $r->cid)
            ->select('customer_products.*', 'products.discount', 'units.name as uname')
            ->first();
        return json_encode($p);
    }

    public function save(Request $r)
    {
        if(!Right::check('invoice', 'i')){
            return 0;
        }
        $m = json_encode($r->invoice);
        $m = json_decode($m);
        $vat = $m->vat;
        $total = $m->total;
        $grand = $total;
        $vat_amount = 0;
        if($vat>0)
        {
            $grand = $total + ($total*$vat/100);
            $vat_amount = $total*$vat/100;
        }
        $data = array(
            'customer_id' => $m->customer_id,
            'invoice_date' => $m->invoice_date,
            'total' => $total,
            'paid' => 0,
            'due_amount' => $grand,
            'note' => $m->note,
            'create_by' => Auth::user()->id,
            'due_date' => $m->due_date,
            'create_at' => date('Y-m-d H:i:s'),
            'reference' => $m->reference,
            'exchange' => $m->exchange,
            'vat' => $m->vat,
            'vat_amount' => $vat_amount,
            'grand_total' => $grand,
            'discount' => $m->g_disc
        );
       
        $i = DB::table('invoices')->insertGetId($data);
        if($i)
        {
            $items = json_encode($r->items);
            $items = json_decode($items);
            
            foreach($items as $item)
            {
                $data1 = array(
                    'product_id' => $item->product_id,
                    'invoice_id' => $i,
                    'quantity' => $item->quanity,
                    'unitprice' => $item->price,
                    'discount' => $item->discount,
                    'subtotal' => $item->total,
                    'create_at' => date('Y-m-d H:i:s'),
                    'create_by' => Auth::user()->id
                );
                // cut stock
                $pid = $item->product_id;
                $x = DB::table('invoice_details')->insert($data1);
                if($x)
                {
                    DB::table('products')
                        ->where('id', $pid)
                        ->decrement('onhand', $item->quanity);
                }
            }
            return $i;
        }
        else {
            return 0;
        }
    }
    public function detail($id)
    {
        if(!Right::check('invoice', 'l')){
            return view('permissions.no');
        }
        $invoice = DB::table('invoices')
            ->leftJoin('customers', 'invoices.customer_id', 'customers.id')
            ->where('invoices.id', $id)
            ->select('invoices.*', 'customers.company_name', 'customers.full_name')
            ->first();
        
        $data['invoice'] = $invoice;

        $data['items'] = DB::table('invoice_details')
            ->join('products', 'invoice_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('invoice_details.invoice_id', $id)
            ->select('invoice_details.*', 'products.name','units.name as uname')
            ->get();
        $data['payments'] = DB::table('payments')
            ->where('invoice_id', $id)
            ->get();
        return view('invoices.detail', $data);
    }
    public function print($id)
    {
        if(!Right::check('invoice', 'l')){
            return view('permissions.no');
        }
        $invoice = DB::table('invoices')
            ->leftJoin('customers', 'invoices.customer_id', 'customers.id')
            ->where('invoices.id', $id)
            ->select('invoices.*', 'customers.company_name', 'customers.en_name',
                'customers.address', 'customers.en_address', 'customers.vatin', 'customers.phone','customers.payment_term')
            ->first();
        
        $data['invoice'] = $invoice;

        $data['items'] = DB::table('invoice_details')
            ->join('products', 'invoice_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('invoice_details.invoice_id', $id)
            ->select('invoice_details.*', 'products.name','units.name as uname', 'products.kh_name',
                'products.barcode', 'products.code')
            ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('invoices.print', $data);
    }
    public function save_payment(Request $r)
    {
        if(!Right::check('invoice', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'invoice_id' => $r->invoice_id,
            'pay_date' => $r->pay_date,
            'amount' => $r->amount,
            'create_at' => date('Y-m-d H:i:s'),
            'create_by' => Auth::user()->id
        );
        $i = DB::table('payments')->insert($data);
        if($i)
        {
            // update invoice
            DB::table('invoices')
                ->where('id', $r->invoice_id)
                ->increment('paid', $r->amount);
            DB::table('invoices')
                ->where('id', $r->invoice_id)
                ->decrement('due_amount', $r->amount);

            $r->session()->flash('success', 'The payment has been saved!');
            return redirect('invoice/detail/'.$r->invoice_id);
        }
        else{
            $r->session()->flash('error', 'Fail to register your payment!');
            return redirect('invoice/detail/'.$r->invoice_id);
        }
    }
    public function delete_payment($id)
    {
        if(!Right::check('invoice', 'd')){
            return view('permissions.no');
        }
        $p = DB::table('payments')->find($id);
        $i = DB::table('payments')
            ->where('id', $id)
            ->delete();
        if($i)
        {
            DB::table('invoices')
                ->where('id', $p->invoice_id)
                ->increment('due_amount', $p->amount);
            DB::table('invoices')
                ->where('id', $p->invoice_id)
                ->decrement('paid', $p->amount);
        }
        return redirect('invoice/detail/'.$p->invoice_id);
    }
    public function delete($id)
    {
        $in = DB::table('invoices')->find($id);
        $details = DB::table('invoice_details')
            ->where('invoice_id', $id)
            ->get();
        $payments = DB::table('payments')
            ->where('invoice_id', $id)
            ->get();
        if(count($payments)>0)
        {
            return redirect('invoice/detail/'.$id)
                ->with('error', 'Cannot delete the invoice because it already has a payment. Please delete payment first!');
        }
        DB::table('invoices')->where('id', $id)->delete();
        DB::table('invoice_details')->where('invoice_id', $id)->delete();
        // restore stock
        foreach($details as $d)
        {
            DB::table('products')
                ->where('id', $d->product_id)
                ->increment('onhand', $d->quantity);
        }
        return redirect('invoice')
            ->with('success', 'Data has been removed!');
    }
    public function get_vat($id)
    {
        $cus = DB::table('customers')->find($id);
        return $cus->vat;
    }
}
