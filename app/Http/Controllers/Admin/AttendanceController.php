<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        return view('backend.attendance.index',[
            'title' => 'Attendance List',
            'page_name' => 'Attendance',
            'page_title' => 'List',
            'datas' => EmployeeAttendance::orderBy('id','desc')->get(),
        ]);
    }

    public function create()
    {
        return view('backend.attendance.create',[
            'title' => 'Attendance Create',
            'page_name' => 'Attendance',
            'page_title' => 'Create',
        ]);
    }
}
