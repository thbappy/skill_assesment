<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeContacts;
use App\Models\EmployeeDetails;
use App\Utlity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index',[
            'title' => 'Employee List',
            'page_name' => 'Employee',
            'page_title' => 'List',
            'datas' => Employee::orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create',[
            'title' => 'Employee Create',
            'page_name' => 'Employee',
            'page_title' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
//            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'image' => 'required|image'
        ]);


        if ($request->hasFile('image')){
            $path = Utlity::file_upload($request,'image','EmployeePhoto');
        }
            $data = new Employee();
            $data->first_name = $request->get('first_name');
            $data->full_name = $request->get('full_name');
            $data->email = $request->get('email');
            $data->password = bcrypt($request->get('password'));
            $data->status = $request->get('status');

            if($data->save()){

                $details = new EmployeeDetails();
                $details->employee_id = $data->id;
                $details->address = $request->get('address');
                $details->photo = $path;
                $details->save();

                $name = $request->contact_name;
                $email = $request->contact_email;

                foreach($name as $key => $ingredient)
                {
                    $contact = new EmployeeContacts();
                    $contact->employee_id = $data->id;
                    $contact->contact_name = $ingredient;
                    $contact->contact_email = $email[$key];
                    $contact->save();
                }

                return redirect()->back()->with("success","Data Added Successfully Done ");
            }
            else {
                return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.users.show',[
            'title' => 'Employee Details',
            'page_name' => 'Employee',
            'page_title' => 'Details',
            'data' => Employee::find($id),
            'contacts' => EmployeeContacts::where('employee_id',$id)->get(),
            'address' => EmployeeDetails::where('employee_id',$id)->first()

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Employee::find($id);
        EmployeeContacts::where('employee_id',$id)->delete();
        $details = EmployeeDetails::where('employee_id',$id)->delete();
        if(file_exists($details->photo)){
            unlink($data->photo);
        }
        if($data->delete()){
            return redirect()->back()->with("success","Data Delete Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }
}
