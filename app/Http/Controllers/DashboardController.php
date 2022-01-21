<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\MyClass;
use App\Subject;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('web');
    }
    public function dashboard()
    {
        $students = Student::count();
        $staffs = User::where('role_id', 1)->orwhere('role_id', 2)->orwhere('role_id', 3)->count();
        $classes = MyClass::count();
        $subjects = Subject::count();
    	return view('index', compact('students','staffs','classes','subjects'));
    }
}
