<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $users = Admin::role('user')->get();
            return view('users.index',compact('users'));
        }
        else
        {
            return abort(401);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('admin'))
        {
                return view('users.create');
        }
        else
        {
            return abort(401);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "first_name" => 'required|string',
            "last_name" => 'required|string',
            "username" => 'required|unique:admins,email|min:5|max:20|string',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'

        ]);
        $admin = Admin::create([
            'email' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
        ]);
        if(!$admin->hasRole('user')){
            $admin->assignRole('user');
        }
        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $user = Admin::findOrFail($id);
            return view('users.edit',compact('user'));
        }
        else
        {
            return abort(401);
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "first_name" => 'required|string',
            "last_name" => 'required|string',
            "username" => 'required||min:5|max:20|string|unique:admins,email,'.$id,
            'password' => 'nullable|min:8|confirmed'
        ]);
        $passwordfield = [];
        if($request->get('password') != null)
        {
            $passwordfield['password'] = Hash::make($request->password);
        }
        Admin::find($id)->update(array_merge([
            'email' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'active' => $request->has('active')?1:0
        ],$passwordfield));
        
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Admin::role('user')->findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
