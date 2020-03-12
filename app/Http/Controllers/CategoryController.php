<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    public function index()
    {
        if(!Right::check('category', 'l')){
            return view('permissions.no');
        }
        $data['cats'] = DB::table('categories')
            ->where('active', 1)
            ->paginate(config('app.row'));
        return view('categories.index', $data);
    }

    public function create()
    {
        if(!Right::check('category', 'i')){
            return view('permissions.no');
        }
        return view('categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        if(!Right::check('category', 'i')){
            return view('permissions.no');
        }
        $r->validate([
            'name' => 'required'
        ]);
        $data = array(
            'name' => $r->name
           
        );
        $i = DB::table('categories')->insert($data);
        if($i){
           return redirect()->route('category.create')
            ->with('success', 'Data has been saved!');
        }
        else{
            return redirect()->route('category.create')
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
        if(!Right::check('category', 'u')){
            return view('permissions.no');
        }
        $data['cat'] = DB::table('categories')->find($id);
        return view('categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        if(!Right::check('category', 'u')){
            return view('permissions.no');
        }
        $r->validate([
            'name' => 'required'
        ]);
        $data = array(
            'name' => $r->name
           
        );
        $i = DB::table('categories')->where('id', $id)->update($data);
        if($i){
            return redirect()->route('category.edit', $id)
                ->with('success', 'Data has been saved!');
        }
        else{
            return redirect()->route('category.edit', $id)
                ->with('error', 'Fail to save data!');
        }
    }

    public function delete($id)
    {
        if(!Right::check('category', 'd')){
            return view('permissions.no');
        }
        DB::table('categories')
            ->where('id', $id)
            ->update(['active'=>0]);
        
        return redirect('category')
            ->with('success', 'Data has been removed!');
    }
}
