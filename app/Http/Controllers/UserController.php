<?php

namespace App\Http\Controllers;
use Auth;
use DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public  function index()
    {
        if(!Right::check('User', 'l')){
            return view('permissions.no');
        }
        $data['users'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->where('users.active', 1)
            ->where('users.username', '!=', 'root')
            ->select("users.*", "roles.name as role_name")
            ->paginate(config('app.row'));
        return view("users.index", $data);
    }
    public function create(){
        if(!Right::check('User', 'i')){
            return view('permissions.no');
        }
        $data['roles'] = DB::table('roles')->where('active', 1)->get();
        return view('users.create',$data);
    }

    public function save(Request $r)
    {
        if(!Right::check('User', 'i')){
            return view('permissions.no');
        }


        $validate = $r->validate([
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required'
		]);
        $data = $r->except('_token', 'photo', 'cpassword');
        $data['password'] = bcrypt($r->password);
        if($r->password!=$r->cpassword){
            $r->session()->flash('error' , 'The password and confirm password is not matached!');
            return redirect('user/create')->withInput();
        }
        if($r->photo){
            $data['photo'] = $r->file('photo')->store('uploads/users', 'custom');
        }
		$i = DB::table('users')->insert($data);
        if($i)
        {
            $r->session()->flash('success' , 'New user has been created.');
            return redirect('user/create');
        }
        else
        {
            $r->session()->flash('error' , 'Can not create. Please check and try again');
            return redirect('user/create')->withInput();
        }
    }
	public function edit($id)
    {
        if(!Right::check('User', 'u')){
            return view('permissions.no');
        }
        $data['roles'] = DB::table('roles')
            ->where('active', 1)
            ->get();
		$data['user'] = DB::table("users")->find($id);
        return view("users.edit", $data);
    }
	public function update(Request $r)
    {
        if(!Right::check('User', 'u')){
            return view('permissions.no');
        }
        $validate = $r->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
		]);
        $data = $r->except('_token', 'photo', 'id', 'password');
        if($r->password!=""){
            $data['password'] = bcrypt($r->password);
        }
        
        if($r->photo){
            $data['photo'] = $r->file('photo')->store('uploads/users', 'custom');
        }
		$i = DB::table('users')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('success' , 'Data has been saved successfully!');
            return redirect('user/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('error' , 'Fail to save change. Please check again!');
            return redirect('user/edit/'.$r->id);
        }
    }
    public function delete($id)
    {
        if(!Right::check('User', 'd')){
            return view('permissions.no');
        }
        DB::table('users')->where('id', $id)
            ->update(['active'=>0]);
        return redirect('user') 
            ->with('success', 'Data has been removed successfully!');
    }
    public function profile()
    {
        $id = Auth::user()->id;
        $data['user'] = DB::table("users")
            ->join('roles', 'users.role_id', 'roles.id')
            ->where('users.id', $id)
            ->select('users.*', 'roles.name as rname')
            ->first();
        return view("users.profile", $data);
    }
    public function save_profile(Request $r)
    {
        $id = Auth::user()->id;
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'email' => $r->email,
            'gender' => $r->gender,
            'phone' => $r->phone,
        );
        if($r->password)
        {
            $data['password'] = bcrypt($r->password);
        }
        if($r->photo)
        {
            $data['photo'] = $r->file('photo')->store('uploads/users', 'custom');
        }
        $i = DB::table('users')
            ->where('id', $id)
            ->update($data);
        if($i)
        {
            return redirect('user/profile')->with('success', 'Data has been saved!');
        }
        else{
            return redirect('user/profile')->with('error', 'Fail to save data, please check again!');
        }
    }
    // user sign out
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
