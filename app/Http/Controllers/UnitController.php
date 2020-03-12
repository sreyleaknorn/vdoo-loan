<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    public function index()
    {
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->paginate(config('app.row'));
        return view('units.index', $data);
    }

    public function create()
    {
        return view('units.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required'
        ]);
        $data = array(
            'name' => $r->name
           
        );
        $i = DB::table('units')->insert($data);
        if($i){
           return redirect('unit/create')
            ->with('success', 'Data has been saved!');
        }
        else{
            return redirect('unit/create')
                ->with('error', 'Fail to save data!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!Right::check('category', 'u')){
        //     return view('permissions.no');
        // }
        $data['unit'] = DB::table('units')->find($id);
        return view('units.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r)
    {
        // if(!Right::check('category', 'u')){
        //     return view('permissions.no');
        // }
        $id = $r->id;
        $r->validate([
            'name' => 'required'
        ]);
        $data = array(
            'name' => $r->name
           
        );
        $i = DB::table('units')->where('id', $id)->update($data);
        if($i){
            return redirect('unit/edit/'. $id)
                ->with('success', 'Data has been saved!');

        }
        else{
            return redirect('unit/edit/'.$id)
                ->with('error', 'Fail to save data!');
        }
    }

    public function delete($id)
    {
        // if(!Right::check('category', 'd')){
        //     return view('permissions.no');
        // }
        DB::table('units')
            ->where('id', $id)
            ->update(['active'=>0]);
        
        return redirect('unit')
            ->with('success', 'Data has been removed!');
    }
}
