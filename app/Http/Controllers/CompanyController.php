<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Right;
use DB;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // load company index
    public function index()
    {
        if(!Right::check('company', 'l')){
            return view('setting::permissions.no');
        }
        $data['company'] = DB::table('companies')
            ->where('id', 1)
            ->first();
        return view('companies.index', $data);
    }
    // edit company form
    public function edit($id)
    {
        if(!Right::check('company', 'u')){
            return view('setting::permissions.no');
        }
        $data['company'] = DB::table('companies')
            ->where('id', $id)
            ->first();

        return view('companies.edit', $data);
    }
    public function save(Request $r)
    {
        if(!Right::check('company', 'u')){
            return view('setting::permissions.no');
        }
        $data = $r->except('_token', 'id', 'logo');

        if($r->hasFile('logo'))
        {
            $data['logo'] = $r->file('logo')->store('uploads/logos/', 'custom');
        }
        $i = DB::table('companies')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('success', 'All changes have been saved successfully.');
            return redirect('company');
        }
        else{
            $r->session()->flash('error', 'Fail to save change, please check again!');
            return redirect('company/edit/'.$r->id);
        }
    }
}
