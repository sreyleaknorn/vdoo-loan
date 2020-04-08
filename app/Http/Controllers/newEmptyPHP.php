<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function onhand()
    {
        if(!Right::check('stock_balance', 'l')){
            return view('permissions.no');
        }
        $data['products'] = DB::table('products')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.active', 1)
            ->select('products.*', 'units.name as uname', 'categories.name as cname')
            ->get();
        return view('reports.report1', $data);
    }
    public function onhand_print()
    {
        if(!Right::check('stock_balance', 'l')){
            return view('permissions.no');
        }
        $data['products'] = DB::table('products')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.active', 1)
            ->select('products.*', 'units.name as uname', 'categories.name as cname')
            ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report1-print', $data);
    }
    public function sale()
    {
        if(!Right::check('sale_report', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $data['sales'] = [];
        $data['pid'] = 'all';
        return view('reports.report2', $data);
    }
    public function search_sale(Request $r)
    {
        if(!Right::check('sale_report', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['pid'] = $r->product;

        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $sales = DB::table('invoice_details')            
            ->join('invoices', 'invoice_details.invoice_id', 'invoices.id')
            ->join('products', 'invoice_details.product_id', 'products.id')
            ->join('customers', 'invoices.customer_id', 'customers.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('invoices.invoice_date','>=', $r->start)
            ->where('invoices.invoice_date', '<=', $r->end);
        if($r->product!='all')    
        {
            $sales = $sales->where('invoice_details.product_id', $r->product);
        }
        $sales = $sales->orderBy('invoice_details.id')
            ->select('invoices.invoice_date', 'invoices.id as inv_no', 'products.name', 'products.kh_name', 
                'invoices.reference', 'units.name as uname', 'invoice_details.*', 'customers.company_name')
            ->get();
        $data['sales'] = $sales;
        return view('reports.report2', $data);
    }
    public function print_sale(Request $r)
    {
        if(!Right::check('sale_report', 'l')){
            return view('permissions.no');
        }
        $data['com'] = DB::table('companies')->find(1);
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $sales = DB::table('invoice_details')            
            ->join('invoices', 'invoice_details.invoice_id', 'invoices.id')
            ->join('products', 'invoice_details.product_id', 'products.id')
            ->join('customers', 'invoices.customer_id', 'customers.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('invoices.invoice_date','>=', $r->start)
            ->where('invoices.invoice_date', '<=', $r->end);
        if($r->pid!='all')    
        {
            $sales = $sales->where('invoice_details.product_id', $r->pid);
        }
        $sales = $sales->orderBy('invoice_details.id')
            ->select('invoices.invoice_date', 'invoices.id as inv_no', 'products.name', 'products.kh_name', 
                'invoices.reference', 'units.name as uname', 'invoice_details.*','customers.company_name')
            ->get();
        $data['sales'] = $sales;
        return view('reports.report2-print', $data);
    }

    public function sale_summary()
    {
        if(!Right::check('sale_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
       
        $data['sales'] = [];
        $data['pid'] = 'all';
        return view('reports.report3', $data);
    }
    public function search_sale_summary(Request $r)
    {
        if(!Right::check('sale_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;

        $sales = DB::select("
            select products.name, products.kh_name, products.code, sum(invoice_details.quantity) as total1,
            sum(invoice_details.subtotal) as total2, units.name as uname  
            from invoice_details  
            inner join invoices on invoice_details.invoice_id=invoices.id 
            inner join products on invoice_details.product_id=products.id
            inner join units on products.unit_id=units.id 
            where invoices.invoice_date>='{$r->start}' and invoices.invoice_date<='{$r->end}' 
            group by products.id, products.name, products.kh_name, products.unit_id, products.code, units.name
        ");
       
        $data['sales'] = $sales;
        return view('reports.report3', $data);
    }
    public function print_sale_summary(Request $r)
    {
        if(!Right::check('sale_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;

        $sales = DB::select("
            select products.name, products.kh_name, products.code, sum(invoice_details.quantity) as total1,
            sum(invoice_details.subtotal) as total2, units.name as uname  
            from invoice_details  
            inner join invoices on invoice_details.invoice_id=invoices.id 
            inner join products on invoice_details.product_id=products.id
            inner join units on products.unit_id=units.id 
            where invoices.invoice_date>='{$r->start}' and invoices.invoice_date<='{$r->end}' 
            group by products.id, products.name, products.unit_id, products.code, products.kh_name,units.name
        ");
        $data['com'] = DB::table('companies')->find(1);
        $data['sales'] = $sales;
        return view('reports.report3-print', $data);
    }
    public function in()
    {
        if(!Right::check('stock_in', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $data['ins'] = [];
        $data['pid'] = 'all';
        return view('reports.report4', $data);
        
    }
    public function search_in(Request $r)
    {
        if(!Right::check('stock_in', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        
        $data['pid'] = $r->product;
        $ins = DB::table('stock_in_details')
            ->join('stock_ins', 'stock_in_details.stock_in_id', 'stock_ins.id')
            ->join('products', 'stock_in_details.product_id', 'products.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('stock_in_details.in_date', '>=', $r->start)
            ->where('stock_in_details.in_date', '<=', $r->end);
        if($r->product!='all')
        {
            $ins = $ins->where('stock_in_details.product_id', $r->product);
        }
        $data['ins'] = $ins->select('stock_in_details.*', 'stock_ins.reference', 'units.name as uname',
            'products.code', 'products.name', 'products.kh_name')
            ->get();
        return view('reports.report4', $data);
        
    }
    public function print_in(Request $r)
    {
        if(!Right::check('stock_in', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;

        $ins = DB::table('stock_in_details')
            ->join('stock_ins', 'stock_in_details.stock_in_id', 'stock_ins.id')
            ->join('products', 'stock_in_details.product_id', 'products.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('stock_in_details.in_date', '>=', $r->start)
            ->where('stock_in_details.in_date', '<=', $r->end);
        if($r->pid!='all')
        {
            $ins = $ins->where('stock_in_details.product_id', $r->pid);
        }
        $data['ins'] = $ins->select('stock_in_details.*', 'stock_ins.reference', 'units.name as uname',
            'products.code', 'products.name', 'products.kh_name')
            ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report4-print', $data);
        
    }
    public function in_summary()
    {
        if(!Right::check('stock_in_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['ins'] = [];
        return view('reports.report5', $data);
    }
    public function search_in_summary(Request $r)
    {
        if(!Right::check('stock_in_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['ins'] = DB::select("
            select products.code, products.name, products.kh_name, units.name as uname, 
            sum(stock_in_details.quantity) as total from stock_in_details 
            inner join products on stock_in_details.product_id=products.id 
            inner join units on products.unit_id=units.id 
            where stock_in_details.in_date >= '{$r->start}' and stock_in_details.in_date <= '{$r->end}' 
            group by products.code, products.name, products.kh_name,
            units.name
        ");
        return view('reports.report5', $data);
    }
    public function print_in_summary(Request $r)
    {
        if(!Right::check('stock_in_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['ins'] = DB::select("
            select products.code, products.name, products.kh_name, units.name as uname, 
            sum(stock_in_details.quantity) as total from stock_in_details 
            inner join products on stock_in_details.product_id=products.id 
            inner join units on products.unit_id=units.id 
            where stock_in_details.in_date >= '{$r->start}' and stock_in_details.in_date <= '{$r->end}' 
            group by products.code, products.name, products.kh_name,
            units.name
        ");
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report5-print', $data);
    }
    public function out()
    {
        if(!Right::check('stock_out', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $data['outs'] = [];
        $data['pid'] = 'all';
        return view('reports.report6', $data);
        
    }
    public function search_out(Request $r)
    {
        if(!Right::check('stock_out', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();

        $data['pid'] = $r->product;
        $outs = DB::table('stock_out_details')
            ->join('stock_outs', 'stock_out_details.stock_out_id', 'stock_outs.id')
            ->join('products', 'stock_out_details.product_id', 'products.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('stock_out_details.out_date','>=', $r->start)
            ->where('stock_out_details.out_date','<=', $r->end);
        if($r->product!='all')
        {
            $outs = $outs->where('stock_out_details.product_id', $r->product);
        }
        $outs = $outs->select('stock_out_details.*','stock_outs.reference', 'products.code', 
                'products.name', 'products.kh_name', 'units.name as uname')
                ->orderBy('stock_out_details.id')
                ->get();
        $data['outs'] = $outs;
        return view('reports.report6', $data);
        
    }
    public function print_out(Request $r)
    {
        if(!Right::check('stock_out', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        
        $outs = DB::table('stock_out_details')
            ->join('stock_outs', 'stock_out_details.stock_out_id', 'stock_outs.id')
            ->join('products', 'stock_out_details.product_id', 'products.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('stock_out_details.out_date','>=', $r->start)
            ->where('stock_out_details.out_date','<=', $r->end);
        if($r->pid!='all')
        {
            $outs = $outs->where('stock_out_details.product_id', $r->pid);
        }
        $outs = $outs->select('stock_out_details.*','stock_outs.reference', 'products.code', 
                'products.name', 'products.kh_name', 'units.name as uname')
                ->orderBy('stock_out_details.id')
                ->get();
        $data['outs'] = $outs;
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report6-print', $data);
        
    }
    public function out_summary()
    {
        if(!Right::check('stock_out_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
       
        $data['outs'] = [];
        return view('reports.report7', $data);
        
    }
    public function search_out_summary(Request $r)
    {
        if(!Right::check('stock_out_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
       
        $data['outs'] = DB::select("
            select products.code, products.name, products.kh_name, sum(stock_out_details.quantity) as total, 
            units.name as uname from stock_out_details 
            inner join products on stock_out_details.product_id=products.id 
            inner join units on products.unit_id=units.id 
            where stock_out_details.out_date between '{$r->start}' and '{$r->end}' 
            group by products.code, products.kh_name, products.name, units.name
        ");
        return view('reports.report7', $data);
        
    }
    public function print_out_summary(Request $r)
    {
        if(!Right::check('stock_out_summary', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
       
        $data['outs'] = DB::select("
            select products.code, products.name, products.kh_name, sum(stock_out_details.quantity) as total, 
            units.name as uname from stock_out_details 
            inner join products on stock_out_details.product_id=products.id 
            inner join units on products.unit_id=units.id 
            where stock_out_details.out_date between '{$r->start}' and '{$r->end}' 
            group by products.code, products.kh_name, products.name, units.name
        ");
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report7-print', $data);
        
    }
    public function customer()
    {
        if(!Right::check('sale_report', 'l')){
            return view('permissions.no');
        }
        $data['start'] = date('Y-m-d');
        $data['end'] = date('Y-m-d');
        $data['customers'] = DB::table('customers')
            ->where('active', 1)
            ->get();
        $data['sales'] = [];
        $data['cid'] = 'all';
        return view('reports.report8', $data);
    }
    public function search_customer(Request $r)
    {
        if(!Right::check('sale_report', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;
        $data['cid'] = $r->customer;

        $data['customers'] = DB::table('customers')
            ->where('active', 1)
            ->get();
        $sales = DB::table('invoice_details')            
            ->join('invoices', 'invoice_details.invoice_id', 'invoices.id')
            ->join('products', 'invoice_details.product_id', 'products.id')
            ->join('customers', 'invoices.customer_id', 'customers.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('invoices.invoice_date','>=', $r->start)
            ->where('invoices.invoice_date', '<=', $r->end)
            ->where('invoices.customer_id', $r->customer);
       
        $sales = $sales->orderBy('invoice_details.id')
            ->select('invoices.invoice_date', 'invoices.id as inv_no', 'products.name', 'products.kh_name', 
                'invoices.reference', 'units.name as uname', 'invoice_details.*')
            ->get();
        $data['sales'] = $sales;
        $data['customer'] = DB::table('customers')->find($r->customer);
        return view('reports.report8', $data);
    }
    public function print_customer(Request $r)
    {
        if(!Right::check('sale_report', 'l')){
            return view('permissions.no');
        }
        $data['start'] = $r->start;
        $data['end'] = $r->end;

        $sales = DB::table('invoice_details')            
            ->join('invoices', 'invoice_details.invoice_id', 'invoices.id')
            ->join('products', 'invoice_details.product_id', 'products.id')
            ->join('customers', 'invoices.customer_id', 'customers.id')
            ->leftJoin('units', 'products.unit_id', 'units.id')
            ->where('invoices.invoice_date','>=', $r->start)
            ->where('invoices.invoice_date', '<=', $r->end)
            ->where('invoices.customer_id', $r->cid);
       
        $sales = $sales->orderBy('invoice_details.id')
            ->select('invoices.invoice_date', 'invoices.id as inv_no', 'products.name', 'products.kh_name', 
                'invoices.reference', 'units.name as uname', 'invoice_details.*')
            ->get();
        $data['sales'] = $sales;
        $data['customer'] = DB::table('customers')->find($r->cid);
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.report8-print', $data);
    }
}
