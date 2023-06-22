<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Divisions;
use App\Models\User;
use App\Models\UserVerify;
use App\Utlity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(){

        return view('backend.users.index',[
            'title' => 'User List',
            'page_name' => 'User',
            'page_title' => 'List',
            'datas' => User::orderBy('id','desc')->get(),
        ]);
    }

    public function create(){
        return view('backend.users.create',[
            'title' => 'User Create',
            'page_name' => 'User',
            'page_title' => 'Create',
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password' => 'required|min:8',
            'role' => 'required',
            'password_confirmation' => 'required|same:password',
            'image' => 'required|image'
        ]);

        if ($request->hasFile('image')){
            $path = Utlity::file_upload($request,'image','User_photos');
        }
        $data = new User();
        $data->name = $request->get('user_name');
        $data->email = $request->get('email');
        $data->password = bcrypt($request->get('password'));
        $data->status = $request->get('status');
        $data->image = $path;

        if($data->save()){
            $data->assignRole($request->get('role'));
            return redirect()->back()->with("success","Data Added Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }

    }

    public function edit($id){

        return view('backend.users.edit',[
            'title' => 'User Update',
            'page_title' => 'User Update',
            'page_name' => ' Update',
            'data' => User::where('id',$id)->first(),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'role' => 'required',
        ]);

        $data = User::findOrFail($id);
        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->status = $request->get('status');
        if($request->hasFile('image')){
            if(file_exists($data->photo)){
                unlink($data->photo);
            }
            $path = Utlity::file_upload($request,'image','User_photos');
            $data->photo = $path;
        }

        if($data->save()){

            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $data->assignRole($request->get('role'));
            return redirect()->back()->with("success","Data Updated Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }

    public function destroy($id){
        if($id == Auth::user()->id){
            return redirect()->back()->with("success","You can not delete Your Account.");
        }
        $data = User::find($id);
        if(file_exists($data->image)){
            unlink($data->image);
        }
        if($data->delete()){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            return redirect()->back()->with("success","Data Delete Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }

    }
}
