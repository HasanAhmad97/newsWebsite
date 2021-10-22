<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class userController extends Controller
{
    public function usersShow(){

        $users = User::get();
        return view('website.users',compact('users'));
    }


    public function usersCreate(){
        $user = Auth::user()->can('show users');

        $roles = Role::all();
//        $roles = Role::pluck('name','name')->all();
//        return($roles);
        return view('website.userCreate',compact('roles','user'));

    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required'
        ]);

        //  User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //      'roles_name'=> $request->roles_name,
        //      'Status' => $request->Status,
        // ]);
       $input = $request->all();


       $input['password'] = Hash::make($input['password']);

       $user = User::create($input);
       $user->assignRole($request->input('roles_name'));
        return back()->with('success','تم اضافة المستخدم بنجاح');

    }



    public function edit($id){
        $users = User::select('name','email','id')->find($id);
        return view('website.userEdit',compact('users'));
    }

    public function userUpdate(Request $request,$id){
        $user = User::find($id);
        $user->update([
            "name"=>$request->name,
            "email"=>$request->email,
        ]);
        return redirect()->route('admin.users');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user -> delete();
        return redirect()->route('admin.users');
    }
}
