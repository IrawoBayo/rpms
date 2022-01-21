<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SsClass;
use App\SsStudent;
use App\SsSubject;
use App\User;
use App\SsResult;
use App\Role;
use App\SsClassTeacher;
use App\SsSubjectTeacher;
use Auth;
use DB;
use Hash;
use App\Session;
use App\SsTeacherRemark;
use App\SsForPrincipal;
use App\SsFinalResult;
use App\SsGraduate;
use App\SsPrincipalRemark;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
 
class SeniorController extends Controller
{
    public function __construct()
    {
    	$this->middleware('web');
    }

    // For Staffs

    public function getmanageStaff()
    {

        $roles = Role::where('id', 7)->orwhere('id', 8)->orwhere('id', 9)->get();
        
        return view ('senior/manageStaff',compact('roles'));
        
        
    }

    public function postManageStaff(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'unique:users|max:255',
            'staff_id_num' => 'unique:users',
            'email' => 'email|unique:users',
            'staff_phone_number' => 'unique:users',
            'password' => 'min:6',
        ]);
        
        User::create([
            'role_id' => $request['role_id'],
            'name' => $request['name'],
            'staff_id_num' => $request['staff_id_num'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'staff_phone_number' => $request['staff_phone_number']
        ]);

        return redirect('ss-manageStaff')->with('flash_message_success','<h3>User Has Been Added</h3>');
        
    }

    public function getlistStaff()
    {
        $staffs = User::where('role_id', 7)->orwhere('role_id', 8)->orwhere('role_id', 9)->get();
        return view ('senior/listStaff', compact('staffs'));
    }

    public function getinactiveStaff()
    {
        $staffs = User::where('role_id', 7)->orwhere('role_id', 8)->orwhere('role_id', 9)->get();
        return view ('senior/inactiveStaff', compact('staffs'));
    }

    public function getEditStaff($id)
    {
        $staff = User::findOrFail($id);
        $roles = Role::where('id', 7)->orwhere('id', 8)->orwhere('id', 9)->get();
        return view('senior/editStaff', compact('roles', 'staff'));
    }

    public function postEditStaff(Request $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect('ss-listStaff')->with('flash_message_success','<p>User Has Been Updated</p>');
    }

    public function deleteStaff($id=null)
    {
        User::where('id', $id)->delete();
        return redirect('ss-listStaff')->with('flash_message_danger','<p>User Has Been Deleted</p>');
    }

    public function changestatus($id)
    {
        $staff=User::find($id);
        $staff->update([
            'active'=> $staff->active == true ? false : true
        ]);
        
        return redirect(route('ss-listStaff'));
       
    }

    // For Classes
    
    public function getManageClass()
    {
        $classes = SsClass::all();
        
        return view ('senior/manageClass', ['classes' => $classes]); 
    }

    public function postManageClass(Request $request)

    {
        SsClass::create($request->all());

        return redirect('ss-manageClass')->with('flash_message_success','<p>Class Added</p>');
    }

    public function getEditClass($id)
    {
        $class = SsClass::findOrFail($id);
        return view('senior/editClass', compact('class'));
    }

    public function postEditClass(Request $request, $id)
    {
        SsClass::findOrFail($id)->update($request->all());
        return redirect('ss-manageClass')->with('flash_message_success','<p>Class Updated</p>');
    }

    public function deleteClass($id=null)
    {
        SsClass::where('id', $id)->delete();
        return redirect('ss-manageClass')->with('flash_message_danger','<p>User Has Been Deleted</p>');
    }

    //For Students

    public function getmanageStudent()
    {

        $myClass = SsClass::all();
        
        return view('senior/manageStudent', compact('myClass'));
    }

    public function postManageStudent(Request $request)
    {
        $validatedData = $request->validate([
            'student_id_num' => 'unique:ss_students',
            'sponsor_phone_number' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // SsStudent::create($request->all());

        $student = new SsStudent;

        $student->class_id = $request->input('class_id');
        $student->student_id_num = $request->input('student_id_num');
        $student->student_name = $request->input('student_name');
        $student->gender = $request->input('gender');
        $student->dob = $request->input('dob');
        $student->student_email = $request->input('student_email');
        $student->student_phone_number = $request->input('student_phone_number');
        $student->lga = $request->input('lga');
        $student->state_of_origin = $request->input('state_of_origin');
        $student->home_address = $request->input('home_address');
        $student->sponsor_email = $request->input('sponsor_email');
        $student->sponsor_phone_number = $request->input('sponsor_phone_number');
 
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/student', $filename);
            $student->image = $filename;
        }
        $student->save();
        
        return redirect('ss-manageStudent')->with('flash_message_success','<p>Student Added</p>');
    }

    public function getlistStudent()
    {
        $students = SsStudent::latest()->get();
        
        return view ('senior/listStudent', compact('students', ['students'=> $students]));
    }

    public function viewStudent($id)
    {
        $student = SsStudent::findOrFail($id);
        
        return view('senior/viewStudent', compact('student'));
    }

    public function getEditStudent($id)
    {
        $student = SsStudent::findOrFail($id);
        $classes = SsClass::all();
        return view('senior/editStudent', compact('student','classes'));
    }

    public function postEditStudent(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        // SsStudent::findOrFail($id)->update($request->all());
        $student = SsStudent::findOrFail($id);

        $student->class_id = $request->input('class_id');
        $student->student_id_num = $request->input('student_id_num');
        $student->student_name = $request->input('student_name');
        $student->gender = $request->input('gender');
        $student->dob = $request->input('dob');
        $student->student_email = $request->input('student_email');
        $student->student_phone_number = $request->input('student_phone_number');
        $student->lga = $request->input('lga');
        $student->state_of_origin = $request->input('state_of_origin');
        $student->home_address = $request->input('home_address');
        $student->sponsor_email = $request->input('sponsor_email');
        $student->sponsor_phone_number = $request->input('sponsor_phone_number');
 
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/student', $filename);
            $student->image = $filename;
        }
        $student->save();
        return redirect('ss-listStudent')->with('flash_message_success','<p>Student Updated</p>');
    }

    public function deleteStudent($id=null)
    {
        SsStudent::where('id', $id)->delete();
        return redirect('ss-listStudent')->with('flash_message_danger','<p>Student Deleted</p>');
    }

    public function getlistGraduates()
    {
        $students = SsGraduate::all();
        $classes = SsClass::all();
        
        return view ('senior/listGraduate', compact('students','classes', ['students'=> $students]));
    }

    public function viewGraduate($id)
    {
        $student = SsGraduate::where('student_id',$id);
        
        return view('viewStudent', compact('student'));
    }

    public function getpromoteStudent()
    {
        $students = SsStudent::all();
        $classes = SsClass::all();
        
        return view ('senior/promoteStudent', compact('students','classes', ['students'=> $students]));
    }

    public function promoteStudent(Request $request)
    {

        $bulk_options = $request['bulk_options'];
        $checkBoxArray = $request['checkBoxArray'];

        if($bulk_options == 'graduate'){
            $graduates = SsStudent::whereIn('id',$checkBoxArray)->get()->toArray();
            foreach($graduates as $graduate){
                SsGraduate::insert($graduate);
            //     Student::destroy($graduate);
            }
            $deletes = SsStudent::whereIn('id',$checkBoxArray)->get();
            // dd($deletes);
            foreach($deletes as $delete){
                // Graduate::insert($graduate);
                // Student::destroy($delete);
                SsStudent::destroy(collect($delete));
            }
            return redirect('ss-promoteStudent')->with('flash_message_success','<p>Students Graduated</p>');
        }else{
            SsStudent::whereIn('id',$checkBoxArray)->update(['class_id' => $bulk_options]);
            return redirect('ss-promoteStudent')->with('flash_message_success','<p>Student Promoted</p>');
        }
                    
                    
    }

    // For Suubjects

    public function getmanageSubject()
    {
        $subjects = SsSubject::all();
        
        return view('senior/manageSubject', ['subjects' => $subjects]); 
    }

    public function postManageSubject(Request $request)
    {
        SsSubject::create($request->all());

        return redirect('ss-manageSubject')->with('flash_message_success','<p>Subject Added</p>');
    }

    public function getEditSubject($id)
    {
        $subject = SsSubject::findOrFail($id);
        return view('senior/editSubject', compact('subject'));
    }

    public function postEditSubject(Request $request, $id)
    {
        SsSubject::findOrFail($id)->update($request->all());
        return redirect('ss-manageSubject')->with('flash_message_success','<p>Subject Updated</p>');
    }

    public function deleteSubject($id=null)
    {
        SsSubject::where('id', $id)->delete();
        return redirect('ss-manageSubject')->with('flash_message_danger','<p>Subject Deleted</p>');
    }

    public function getsubjectComb()
    {
        $myClass = SsClass::all();
        $subjects = SsSubject::all();
        $subjectcombinations = Subjectcombination::all();

        return view ('subjectComb', compact('myClass', 'subjects','subjectcombinations',['subjectcombinations'=> $subjectcombinations]));
    }

    public function postSubjectcombination(Request $request)
    {
        Subjectcombination::create($request->all());

        return view ('subjectComb');
    }


    // For Class Teachers

    public function getClassTeacher()
    {   
        $classes = SsClass::all();       
        $teachers = User::where('role_id', 8)->get();
        $classteachers = SsClassTeacher::latest()->get();

        return view ('senior/classTeacher', compact('classes', 'teachers', 'classteachers'));     
    }

    public function postClassTeacher(Request $request)

    {
        foreach($request->class_id as $key=>$val)
        {
            $test = SsClassTeacher::create([
                'user_id' => $request->user_id[$key],
                'class_id' => $val,
            ]);        
        }

        return redirect('ss-classTeacher')->with('flash_message_success','<h3>Class Teacher(s) Created Successfully</h3>');        
    }

    public function getEditCT($id)
    {
        $classes = SsClass::all();       
        $teachers = User::where('role_id', 8)->get();
        $ct = SsClassTeacher::findOrFail($id);
        return view('senior/editCT', compact('ct', 'classes', 'teachers'));
    }

    public function postEditCT(Request $request, $id)
    {
        SsClassTeacher::findOrFail($id)->update($request->all());
        return redirect('ss-classTeacher')->with('flash_message_success','<p>Class Teacher Updated</p>');
    }

    public function deleteCT($id=null)
    {
        SsClassTeacher::where('id', $id)->delete();
        return redirect('ss-classTeacher')->with('flash_message_danger','<p>Class Teacher Deleted</p>');
    }

    //For Subject Teacher

    public function getSubjectTeacher()
    {   

        $subjects = SsSubject::all(); 
        $teachers = User::where('role_id', 8)->get();
        $subjectteachers = SsSubjectTeacher::latest()->get();
        return view ('senior/subjectTeacher', compact('subjects', 'teachers', 'subjectteachers'));        
        
    }

    public function postSubjectTeacher(Request $request)

    {
        foreach($request->subject_id as $key=>$val)
        {
            $test = SsSubjectTeacher::create([
                'user_id' => $request->user_id[$key],
                'subject_id' => $val,
            ]);          
            
        }

        return redirect('ss-subjectTeacher')->with('flash_message_success','<h3>Subject Teacher(s) Created Successfully</h3>');        
    }

    public function getEditST($id)
    {
        $subjects = SsSubject::all(); 
        $teachers = User::where('role_id', 8)->get();
        $st = SsSubjectTeacher::findOrFail($id);
        return view('senior/editST', compact('st', 'subjects', 'teachers'));
    }

    public function postEditST(Request $request, $id)
    {
        SsSubjectTeacher::findOrFail($id)->update($request->all());
        return redirect('ss-subjectTeacher')->with('flash_message_success','<p>Subject Teacher Updated</p>');
    }

    public function deleteST($id=null)
    {
        SsSubjectTeacher::where('id', $id)->delete();
        return redirect('ss-subjectTeacher')->with('flash_message_danger','<p>Subject Teacher Deleted</p>');
    }
    
    
   // Admin Check Student Result

    public function adminStudentResult()
    {
        $sessions = Session::all();
        $cteach = SsClass::all();

        return view('senior/adminStudentResult', compact('sessions', 'cteach'));
    }

    public function adminGetStudentResult()
    {
        $sessions = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $cteach = SsClass::all();
        $student = SsStudent::where(['student_id_num' => Input::get('regno')])->first();

        if(!$student)
        {
            abort(500);
        }
        $dob = $student->dob;
        $age = \Carbon::parse($dob)->age;
        $class = SsClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('test_score');
        $exam = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('total');
        }else {
            $total = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('final_cum');
        }
            
        $obt = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = SsFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->get();
        $check = SsFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->count();
        $tRemark = SsTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();
        $pRemark = SsPrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();

        return view('senior/adminGetResult', compact('sessions','term', 'cteach','dob','age','class', 'student','test','exam','total','obt','percent', 'results','check','tRemark','pRemark'));
    }

    // Admin Delete Result
    public function adminDeleteResult($id=null)
    {
        SsFinalResult::where('id', $id)->delete();
        return back()->with('flash_message_danger','<p>Result Deleted</p>');
    }

    // For Results

    public function getmanageResult()
    {

        $myclass = SsClass::all();
        $sessions = Session::all();
        $subjects = SsSubjectTeacher::where(['user_id' => Auth::user()->id])->get();
        $results = SsResult::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->get();
        
        return view ('senior/manageResult', compact('myclass', 'subjects', 'results', 'sessions'));
        
        
    }
    public function showStudents(Request $request) 
    {        
        if ($request->ajax())
        {
            return response(SsStudent::where('class_id',$request->class_id)->get());
        }
    }

    public function postmanageResult(Request $request)
    {
        // SsResult::create($request->all());

        $term = $request['term'];
        if($term == 'First Term')
        {
            SsResult::create([
                'user_id' => $request['user_id'],
                'session_id' => $request['session_id'],
                'term' => $request['term'],
                'subject_id' => $request['subject_id'],
                'class_id' => $request['class_id'],
                'student_id' => $request['student_id'],
                'test_score' => $request['test_score'],
                'exam_score' => $request['exam_score'],
                'total' => $request['total'],
                'grade' => $request['grade'],
                'remarks' => $request['remarks']
            ]);
        }else if($term == 'Second Term')
        {
            //For Second Term
            $last_total = DB::table('ss_final_results')->select('total')->where(['student_id' => $request['student_id']])
                ->where(['subject_id' => $request['subject_id']])->orderBy('id','DESC')->first();
           
            $new_toal = $request['total'];
            if($last_total == null)
            {
                
                $sum = (int)round($new_toal);
            }else if($last_total >= '0')
            {
                $sum = (int)round(($last_total->total + $new_toal) / 2);
            
            }
            if ($sum <= 39) {
                $grade = 'F';
                $remark = 'Fail';
            }
            else if ($sum >= 40 && $sum <=44){
                $grade = 'E8';
                $remark = 'Pass';
            }
            else if ($sum >= 45 && $sum <=49){
                $grade = 'D7';
                $remark = 'Pass';
            }
            else if($sum >= 50 && $sum <=54){
                $grade = 'C6';
                $remark = 'Credit';
            } 
            else if($sum >= 55 && $sum <=59){
                $grade = 'C5';
                $remark = 'Credit';
            } 
            else if($sum >= 60 && $sum <=64){
                $grade = 'c4';
                $remark = 'Credit';
            } 
            else if($sum >= 65 && $sum <=69){
                $grade = 'B3';
                $remark = 'Good';
            } 
            else if($sum >= 70 && $sum <=74){
                $grade = 'B2';
                $remark = 'Very Good';
            } 
            else {
                $grade = 'A';
                $remark = 'Excellent';
            }

            SsResult::create([
                'user_id' => $request['user_id'],
                'session_id' => $request['session_id'],
                'term' => $request['term'],
                'subject_id' => $request['subject_id'],
                'class_id' => $request['class_id'],
                'student_id' => $request['student_id'],
                'test_score' => $request['test_score'],
                'exam_score' => $request['exam_score'],
                'total' => $request['total'],
                'grade' => $grade,
                'ltc' => $last_total != null? $last_total->total : null,
                'final_cum' => $sum,
                'remarks' => $remark
            ]);

        }else
        {
            //For Third Term
            $last_total2 = DB::table('ss_final_results')->select('final_cum')->where(['student_id' => $request['student_id']])
                ->where(['subject_id' => $request['subject_id']])->orderBy('id','DESC')->first();
            $new_toal2 = $request['total'];
            if($last_total2 == null)
            {
                
                $sum2 = (int)round($new_toal2);
            }else if($last_total2 >= '0')
            {
                $sum2 = (int)round(($last_total2->final_cum + $new_toal2) / 2);
            
            }

            if ($sum2 <= 39) {
                $grade = 'F';
                $remark = 'Fail';
            }
            else if ($sum2 >= 40 && $sum2 <=44){
                $grade = 'E8';
                $remark = 'Pass';
            }
            else if ($sum2 >= 45 && $sum2 <=49){
                $grade = 'D7';
                $remark = 'Pass';
            }
            else if($sum2 >= 50 && $sum2 <=54){
                $grade = 'C6';
                $remark = 'Credit';
            } 
            else if($sum2 >= 55 && $sum2 <=59){
                $grade = 'C5';
                $remark = 'Credit';
            } 
            else if($sum2 >= 60 && $sum2 <=64){
                $grade = 'c4';
                $remark = 'Credit';
            } 
            else if($sum2 >= 65 && $sum2 <=69){
                $grade = 'B3';
                $remark = 'Good';
            } 
            else if($sum2 >= 70 && $sum2 <=74){
                $grade = 'B2';
                $remark = 'Very Good';
            } 
            else {
                $grade = 'A';
                $remark = 'Excellent';
            }

            SsResult::create([
                'user_id' => $request['user_id'],
                'session_id' => $request['session_id'],
                'term' => $request['term'],
                'subject_id' => $request['subject_id'],
                'class_id' => $request['class_id'],
                'student_id' => $request['student_id'],
                'test_score' => $request['test_score'],
                'exam_score' => $request['exam_score'],
                'total' => $request['total'],
                'grade' => $grade,
                'ltc' => $last_total2 != null? $last_total2->final_cum : null,
                'final_cum' => $sum2,
                'remarks' => $remark
            ]);
        }

        return redirect('ss-manageResult')->with('flash_message_success', '<p>Result Added</p>');
    }

    // public function getEditResult($id)
    // {
    //     $myclass = SsClass::all();
    //     $sessions = Session::all();
    //     $subjects = SsSubjectTeacher::where(['user_id' => Auth::user()->id])->get();
    //     $result = SsResult::findOrFail($id);
        
    //     return view('editResult', compact('result', 'subjects', 'myclass', 'session'));
    // }

    // public function postEditResult(Request $request, $id)
    // {
    //     SsResult::findOrFail($id)->update($request->all());
    //     return redirect('manageResult')->with('flash_message_success','<p>Result Updated</p>');
    // }

    public function deleteResult($id=null)
    {
        SsResult::where('id', $id)->delete();
        return redirect('ss-manageResult')->with('flash_message_danger','<p>Result Deleted</p>');
    }

    public function readData()
    {
        $results = SsResult::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->get();
        // $results = SsResult::orderBy('result_id','DESC')->get();
        // dd($results); die();
        // return response($results);
        return view('senior/resultList', compact('results'));
    }
    
    public function getcheckResult()
    {        
        $sessions = Session::all();
        $cteach = SsClassTeacher::where(['user_id' => Auth::user()->id])->get();
        $stud = SsStudent::where(['id' => Input::get('student_id')])->first();
        $ss = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $class = SsClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('ss_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('test_score');
        $exam = DB::table('ss_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('ss_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('total');
        }else {
            $total = DB::table('ss_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('final_cum');
        }
            
        $obt = DB::table('ss_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = SsResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->get();
        
        $pRemark = SsTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->count();
        
        return view ('senior/checkResult', compact('sessions', 'cteach','stud','ss','term','class', 'results', 'test', 'exam', 'total', 'obt','percent','pRemark'));
        
    }
    
    public function postTeacherRemark(Request $request)
    {        
        SsTeacherRemark::create($request->all());        
        return redirect ('ss-checkResult')->with('flash_message_success', '<p>Your Remark have been added</p>');
        
    }

    public function showPercentage(Request $request) 
    {        
        if ($request->ajax())
        {
            return response(SsResult::where('student_id',$request->student_id)->get());
        }
    }

    public function showAllClassResult() 
    {        
        $sessions = Session::all();
        $cteach = SsClassTeacher::where(['user_id' => Auth::user()->id])->first();
        $check = SsResult::count();
        
        return view('senior/classResult', compact('sessions','cteach','check'));
    }


    public function ClassTeacherApproval() 
    {        
        // $sessions = Session::all();
        $cteach = SsClassTeacher::where(['user_id' => Auth::user()->id])->first();
        $copy = SsResult::where('class_id', '=', $cteach->class_id )->get()->toArray();


        $count = SsForPrincipal::where('user_id',  Auth::user()->id)->count();

        foreach ($copy as $c) 
        {
            SsForPrincipal::create($c);
        };
        DB::table('ss_results')->where('class_id', $cteach->class_id )->delete();

        return redirect('ss-classResult')->with('flash_message_success', '<p>RESULTS APPROVED</p>');
    }
    
    public function getPrincipalRemark()
    {        
        $sessions = Session::all();
        $cteach = SsClass::all();
        $stud = SsStudent::where(['id' => Input::get('student_id')])->first();
        $ss = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $class = SsClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('ss_for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('test_score');
        $exam = DB::table('ss_for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('ss_for_principals')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('total');
        }else {
            $total = DB::table('ss_for_principals')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('final_cum');
        }
            
        $obt = DB::table('ss_for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = SsForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->get();
        
        $ctRemark = SsTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->first();
        
        $pRemark = SsPrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->count();

            // dd($pRemark); die();
        
        return view ('senior/principalRemark', compact('sessions','ss','term','class', 'cteach', 'stud', 'results', 'ctRemark', 'pRemark', 'test', 'exam', 'total', 'obt','percent'));
        
    }
    
    public function postPrincipalRemark(Request $request)
    {        
        SsPrincipalRemark::create($request->all());        
        return redirect('ss-principalRemark')->with('flash_message_success', '<p>REMARK ADDED</p>');
        
    }

    public function principalApproval() 
    {        
        $sessions = Session::all();
        $classes = SsClass::all();
        $check = SsForPrincipal::count();
        $results = SsForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->get();
        
        return view('senior/principalApproval', compact('sessions','classes','results','check'));
    }

    public function postPrincipalApproval() 
    {   
        $copy = SsForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->get()->toArray();

        foreach ($copy as $c) 
        {
            SsFinalResult::create($c);
        };
        DB::table('ss_for_principals')->where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->delete();
        
        return redirect('ss-principalApproval')->with('flash_message_success', '<p>RESULT APPROVED</p>');
    }

    // public function postcreateSubject(Request $request)
    // {
       
    //     $subject_name = $request['subject_name'];
    //     $subject_code = $request['subject_code'];

    //     $manageSubject = new Subject();
    //     $manageSubject->subject_name = $subject_name;
    //     $manageSubject->subject_code = $subject_code;


    //     $manageSubject->save();

    //     return redirect()->back();

    // }



    // public function createSubject(Request $request)
    // {
    //     if ($request->ajax())
    //     {
    //         return response(SsSubject::create($request->all()));
    //     }
    // }


    // Change Password


    public function showPassword(Request $request)
    {
        return view('senior/changePasword');
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $check_password = User::where(['name'=> Auth::user()->name])->first();
            $pwdOld = $data['oldPwd'];
            if(Hash::check($pwdOld,$check_password->password)){
                $password = $data['newPwd'];
                $confirm = $data['confirm'];
                if($password == $confirm)
                {
                    $password = Hash::make($data['newPwd']);
                    User::where('name',Auth::user()->name)->update(['password'=>$password]);
                    return redirect('change-password')->with('flash_message_success','Password updated Successfully!');
                }else{
                    return redirect('change-password')->with('flash_message_error','Password Do Not Match!');
                }
            }else {
                return redirect('change-password')->with('flash_message_error','Incorrect Current Password!');
            }
        }
    }


    // Check Student Result

    public function showStudentResult()
    {
        $sessions = Session::all();
        $cteach = SsClass::all();

        return view('senior/studentResult', compact('sessions', 'cteach'));
    }

    public function getStudentResult()
    {
        $sessions = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $cteach = SsClass::all();
        $student = SsStudent::where(['student_id_num' => Input::get('regno')])->first();

        if(!$student)
        {
            abort(500);
        }
        $dob = $student->dob;
        $age = \Carbon::parse($dob)->age;
        $class = SsClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('test_score');
        $exam = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('total');
        }else {
            $total = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('final_cum');
        }
            
        $obt = DB::table('ss_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = SsFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->get();
        $check = SsFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->count();
        $tRemark = SsTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();
        $pRemark = SsPrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();

        return view('senior/printResult', compact('sessions','term', 'cteach','dob','age','class', 'student','test','exam','total','obt','percent', 'results','check','tRemark','pRemark'));
    }

    public function select()
    {
        return view('select');
    }
}


