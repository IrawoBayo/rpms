<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriClass;
use App\PriStudent;
use App\PriSubject;
use App\User;
use App\PriResult;
use App\Role;
use App\PriClassTeacher;
use App\PriSubjectTeacher;
use Auth;
use DB;
use Hash;
use App\Session;
use App\PriTeacherRemark;
use App\PriForPrincipal;
use App\PriFinalResult;
use App\PriPrincipalRemark;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\PriGraduate;
 
class PrimaryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('web');
    }

    // For Staffs

    public function getmanageStaff()
    {

        $roles = Role::where('id', 4)->orwhere('id', 5)->orwhere('id', 6)->get();
        
        return view ('primary/manageStaff',compact('roles'));
        
        
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

        return redirect('pri-manageStaff')->with('flash_message_success','<h3>User Has Been Added</h3>');
        
    }

    public function getlistStaff()
    {
        $staffs = User::where('role_id', 4)->orwhere('role_id', 5)->orwhere('role_id', 6)->get();
        return view ('primary/listStaff', compact('staffs'));
    }

    public function getinactiveStaff()
    {
        $staffs = User::where('role_id', 4)->orwhere('role_id', 5)->orwhere('role_id', 6)->get();
        return view ('primary/inactiveStaff', compact('staffs'));
    }

    public function getEditStaff($id)
    {
        $staff = User::findOrFail($id);
        $roles = Role::where('id', 4)->orwhere('id', 5)->orwhere('id', 6)->get();
        return view('primary/editStaff', compact('roles', 'staff'));
    }

    public function postEditStaff(Request $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect('pri-listStaff')->with('flash_message_success','<p>User Has Been Updated</p>');
    }

    public function deleteStaff($id=null)
    {
        User::where('id', $id)->delete();
        return redirect('pri-listStaff')->with('flash_message_danger','<p>User Has Been Deleted</p>');
    }

    public function changestatus($id)
    {
        $staff=User::find($id);
        $staff->update([
            'active'=> $staff->active == true ? false : true
        ]);
        
        return redirect(route('pri-listStaff'));
       
    }

    // For Classes
    
    public function getManageClass()
    {
        $classes = PriClass::all();
        
        return view ('primary/manageClass', ['classes' => $classes]); 
    }

    public function postManageClass(Request $request)

    {
        PriClass::create($request->all());

        return redirect('pri-manageClass')->with('flash_message_success','<p>Class Added</p>');
    }

    public function getEditClass($id)
    {
        $class = PriClass::findOrFail($id);
        return view('primary/editClass', compact('class'));
    }

    public function postEditClass(Request $request, $id)
    {
        PriClass::findOrFail($id)->update($request->all());
        return redirect('pri-manageClass')->with('flash_message_success','<p>Class Updated</p>');
    }

    public function deleteClass($id=null)
    {
        PriClass::where('id', $id)->delete();
        return redirect('pri-manageClass')->with('flash_message_danger','<p>User Has Been Deleted</p>');
    }

    //For Students

    public function getmanageStudent()
    {

        $myClass = PriClass::all();
        
        return view('primary/manageStudent', compact('myClass'));
    }

    public function postManageStudent(Request $request)
    {
        $validatedData = $request->validate([
            'student_id_num' => 'unique:pri_students',
            'sponsor_phone_number' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // PriStudent::create($request->all());

        $student = new PriStudent;

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
        
        return redirect('pri-manageStudent')->with('flash_message_success','<p>Student Added</p>');
    }

    public function getlistStudent()
    {
        $students = PriStudent::latest()->get();
        
        return view ('primary/listStudent', compact('students', ['students'=> $students]));
    }

    public function viewStudent($id)
    {
        $student = PriStudent::findOrFail($id);
        
        return view('primary/viewStudent', compact('student'));
    }

    public function getEditStudent($id)
    {
        $student = PriStudent::findOrFail($id);
        $classes = PriClass::all();
        return view('primary/editStudent', compact('student','classes'));
    }

    public function postEditStudent(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        // PriStudent::findOrFail($id)->update($request->all());

        $student = PriStudent::findOrFail($id);

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
        return redirect('pri-listStudent')->with('flash_message_success','<p>Student Updated</p>');
    }

    public function deleteStudent($id=null)
    {
        PriStudent::where('id', $id)->delete();
        return redirect('pri-listStudent')->with('flash_message_danger','<p>Student Deleted</p>');
    }

    public function getlistGraduates()
    {
        $students = PriGraduate::all();
        $classes = PriClass::all();
        
        return view ('primary/listGraduate', compact('students','classes', ['students'=> $students]));
    }

    public function viewGraduate($student_id)
    {
        $student = PriGraduate::where('student_id',$student_id);
        
        return view('viewStudent', compact('student'));
    }

    public function getpromoteStudent()
    {
        $students = PriStudent::all();
        $classes = PriClass::all();
        
        return view ('primary/promoteStudent', compact('students','classes', ['students'=> $students]));
    }

    public function promoteStudent(Request $request)
    {

        $bulk_options = $request['bulk_options'];
        $checkBoxArray = $request['checkBoxArray'];

        if($bulk_options == 'graduate'){
            $graduates = PriStudent::whereIn('id',$checkBoxArray)->get()->toArray();
            foreach($graduates as $graduate){
                PriGraduate::insert($graduate);
            //     Student::destroy($graduate);
            }
            $deletes = PriStudent::whereIn('id',$checkBoxArray)->get();
            // dd($deletes);
            foreach($deletes as $delete){
                // Graduate::insert($graduate);
                // Student::destroy($delete);
                PriStudent::destroy(collect($delete));
            }
            return redirect('pri-promoteStudent')->with('flash_message_success','<p>Students Graduated</p>');
        }else{
            PriStudent::whereIn('id',$checkBoxArray)->update(['class_id' => $bulk_options]);
            return redirect('pri-promoteStudent')->with('flash_message_success','<p>Student Promoted</p>');
        }
                    
                    
    }

    // For Suubjects

    public function getmanageSubject()
    {
        $subjects = PriSubject::all();
        
        return view('primary/manageSubject', ['subjects' => $subjects]); 
    }

    public function postManageSubject(Request $request)
    {
        PriSubject::create($request->all());

        return redirect('pri-manageSubject')->with('flash_message_success','<p>Subject Added</p>');
    }

    public function getEditSubject($id)
    {
        $subject = PriSubject::findOrFail($id);
        return view('primary/editSubject', compact('subject'));
    }

    public function postEditSubject(Request $request, $id)
    {
        PriSubject::findOrFail($id)->update($request->all());
        return redirect('pri-manageSubject')->with('flash_message_success','<p>Subject Updated</p>');
    }

    public function deleteSubject($id=null)
    {
        PriSubject::where('id', $id)->delete();
        return redirect('pri-manageSubject')->with('flash_message_danger','<p>Subject Deleted</p>');
    }

    public function getsubjectComb()
    {
        $myClass = PriClass::all();
        $subjects = PriSubject::all();
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
        $classes = PriClass::all();       
        $teachers = User::where('role_id', 5)->get();
        $classteachers = PriClassTeacher::latest()->get();

        return view ('primary/classTeacher', compact('classes', 'teachers', 'classteachers'));     
    }

    public function postClassTeacher(Request $request)

    {
        foreach($request->class_id as $key=>$val)
        {
            $test = PriClassTeacher::create([
                'user_id' => $request->user_id[$key],
                'class_id' => $val,
            ]);        
        }

        return redirect('pri-classTeacher')->with('flash_message_success','<h3>Class Teacher(s) Created Successfully</h3>');        
    }

    public function getEditCT($id)
    {
        $classes = PriClass::all();       
        $teachers = User::where('role_id', 5)->get();
        $ct = PriClassTeacher::findOrFail($id);
        return view('primary/editCT', compact('ct', 'classes', 'teachers'));
    }

    public function postEditCT(Request $request, $id)
    {
        PriClassTeacher::findOrFail($id)->update($request->all());
        return redirect('pri-classTeacher')->with('flash_message_success','<p>Class Teacher Updated</p>');
    }

    public function deleteCT($id=null)
    {
        PriClassTeacher::where('id', $id)->delete();
        return redirect('pri-classTeacher')->with('flash_message_danger','<p>Class Teacher Deleted</p>');
    }

    //For Subject Teacher

    public function getSubjectTeacher()
    {   

        $subjects = PriSubject::all(); 
        $teachers = User::where('role_id', 5)->get();
        $subjectteachers = PriSubjectTeacher::latest()->get();
        return view ('primary/subjectTeacher', compact('subjects', 'teachers', 'subjectteachers'));        
        
    }

    public function postSubjectTeacher(Request $request)

    {
        foreach($request->subject_id as $key=>$val)
        {
            $test = PriSubjectTeacher::create([
                'user_id' => $request->user_id[$key],
                'subject_id' => $val,
            ]);          
            
        }

        return redirect('pri-subjectTeacher')->with('flash_message_success','<h3>Subject Teacher(s) Created Successfully</h3>');        
    }

    public function getEditST($id)
    {
        $subjects = PriSubject::all(); 
        $teachers = User::where('role_id', 5)->get();
        $st = PriSubjectTeacher::findOrFail($id);
        return view('primary/editST', compact('st', 'subjects', 'teachers'));
    }

    public function postEditST(Request $request, $id)
    {
        PriSubjectTeacher::findOrFail($id)->update($request->all());
        return redirect('pri-subjectTeacher')->with('flash_message_success','<p>Subject Teacher Updated</p>');
    }

    public function deleteST($id=null)
    {
        PriSubjectTeacher::where('id', $id)->delete();
        return redirect('pri-subjectTeacher')->with('flash_message_danger','<p>Subject Teacher Deleted</p>');
    }
    
    
    // Admin Check Student Result

    public function adminStudentResult()
    {
        $sessions = Session::all();
        $cteach = PriClass::all();

        return view('primary/adminStudentResult', compact('sessions', 'cteach'));
    }

    public function adminGetStudentResult()
    {
        $sessions = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $cteach = PriClass::all();
        $student = PriStudent::where(['student_id_num' => Input::get('regno')])->first();

        if(!$student)
        {
            abort(500);
        }
        $dob = $student->dob;
        $age = \Carbon::parse($dob)->age;
        $class = PriClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('test_score');
        $exam = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('total');
        }else {
            $total = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('final_cum');
        }
                
        $obt = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = PriFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->get();
        $check = PriFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->count();
        $tRemark = PriTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();
        $pRemark = PriPrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();

        return view('primary/adminGetResult', compact('sessions','term', 'cteach','dob','age','class', 'student','test','exam','total','obt','percent', 'results','check','tRemark','pRemark'));
    }

    // Admin Delete Result
    public function adminDeleteResult($id=null)
    {
        PriFinalResult::where('id', $id)->delete();
        return back()->with('flash_message_danger','<p>Result Deleted</p>');
    }

    // For Results

    public function getmanageResult()
    {

        $myclass = PriClass::all();
        $sessions = Session::all();
        $subjects = PriSubjectTeacher::where(['user_id' => Auth::user()->id])->get();
        $results = PriResult::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->get();
        
        return view ('primary/manageResult', compact('myclass', 'subjects', 'results', 'sessions'));
        
        
    }
    public function showStudents(Request $request) 
    {        
        if ($request->ajax())
        {
            return response(PriStudent::where('class_id',$request->class_id)->get());
        }
    }

    public function postmanageResult(Request $request)
    {
        // PriResult::create($request->all());

        $term = $request['term'];
        if($term == 'First Term')
        {
            PriResult::create([
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
            $last_total = DB::table('pri_final_results')->select('total')->where(['student_id' => $request['student_id']])
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
            else if ($sum >= 40 && $sum <=49){
                $grade = 'D';
                $remark = 'Pass';
            }
            else if($sum >= 50 && $sum <=59){
                $grade = 'C';
                $remark = 'Credit';
            } 
            else if($sum >= 60 && $sum <=69){
                $grade = 'B';
                $remark = 'Good';
            } 
            else {
                $grade = 'A';
                $remark = 'Excellent';
            }

            PriResult::create([
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
            $last_total2 = DB::table('pri_final_results')->select('final_cum')->where(['student_id' => $request['student_id']])
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
            else if ($sum2 >= 40 && $sum2 <=49){
                $grade = 'D';
                $remark = 'Pass';
            }
            else if($sum2 >= 50 && $sum2 <=59){
                $grade = 'C';
                $remark = 'Credit';
            } 
            else if($sum2 >= 60 && $sum2 <=69){
                $grade = 'B';
                $remark = 'Good';
            } 
            else {
                $grade = 'A';
                $remark = 'Excellent';
            }

            PriResult::create([
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

        return redirect('pri-manageResult')->with('flash_message_success', '<p>Result Added</p>');
    }

    // public function getEditResult($id)
    // {
    //     $myclass = PriClass::all();
    //     $sessions = Session::all();
    //     $subjects = PriSubjectTeacher::where(['user_id' => Auth::user()->id])->get();
    //     $result = PriResult::findOrFail($id);
        
    //     return view('editResult', compact('result', 'subjects', 'myclass', 'session'));
    // }

    // public function postEditResult(Request $request, $id)
    // {
    //     PriResult::findOrFail($id)->update($request->all());
    //     return redirect('manageResult')->with('flash_message_success','<p>Result Updated</p>');
    // }

    public function deleteResult($id=null)
    {
        PriResult::where('id', $id)->delete();
        return redirect('pri-manageResult')->with('flash_message_danger','<p>Result Deleted</p>');
    }

    public function readData()
    {
        $results = PriResult::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->get();
        // $results = PriResult::orderBy('result_id','DESC')->get();
        // dd($results); die();
        // return response($results);
        return view('primary/resultList', compact('results'));
    }
    
    public function getcheckResult()
    {        
        $sessions = Session::all();
        $cteach = PriClassTeacher::where(['user_id' => Auth::user()->id])->get();
        $stud = PriStudent::where(['id' => Input::get('student_id')])->first();
        $ss = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $class = PriClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('pri_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('test_score');
        $exam = DB::table('pri_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('pri_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('total');
        }else {
            $total = DB::table('pri_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('final_cum');
        }
                
        $obt = DB::table('pri_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = PriResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->get();
        
        $pRemark = PriTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->count();
        
        return view ('primary/checkResult', compact('sessions', 'cteach','stud','ss','term','class', 'results', 'test', 'exam', 'total', 'obt','percent','pRemark'));
        
    }
    
    public function postTeacherRemark(Request $request)
    {        
        PriTeacherRemark::create($request->all());        
        return redirect ('pri-checkResult')->with('flash_message_success', '<p>Your Remark have been added</p>');
        
    }

    public function showPercentage(Request $request) 
    {        
        if ($request->ajax())
        {
            return response(PriResult::where('student_id',$request->student_id)->get());
        }
    }

    public function showAllClassResult() 
    {        
        $sessions = Session::all();
        $cteach = PriClassTeacher::where(['user_id' => Auth::user()->id])->first();
        $check = PriResult::count();
        
        return view('primary/classResult', compact('sessions','cteach','check'));
    }


    public function ClassTeacherApproval() 
    {        
        // $sessions = Session::all();
        $cteach = PriClassTeacher::where(['user_id' => Auth::user()->id])->first();
        $copy = PriResult::where('class_id', '=', $cteach->class_id )->get()->toArray();


        $count = PriForPrincipal::where('user_id',  Auth::user()->id)->count();

        foreach ($copy as $c) 
        {
            PriForPrincipal::create($c);
        };
        DB::table('pri_results')->where('class_id', $cteach->class_id )->delete();

        return redirect('pri-classResult')->with('flash_message_success', '<p>RESULTS APPROVED</p>');
    }
    
    public function getPrincipalRemark()
    {        
        $sessions = Session::all();
        $cteach = PriClass::all();
        $stud = PriStudent::where(['id' => Input::get('student_id')])->first();
        $ss = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $class = PriClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('pri_for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('test_score');
        $exam = DB::table('pri_for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('pri_for_principals')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('total');
        }else {
            $total = DB::table('pri_for_principals')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('final_cum');
        }
                
        $obt = DB::table('pri_for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = PriForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->get();
        
        $ctRemark = PriTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->first();
        
        $pRemark = PriPrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->count();

            // dd($pRemark); die();
        
        return view ('primary/principalRemark', compact('sessions','ss','term','class', 'cteach', 'stud', 'results', 'ctRemark', 'pRemark', 'test', 'exam', 'total', 'obt','percent'));
        
    }
    
    public function postPrincipalRemark(Request $request)
    {        
        PriPrincipalRemark::create($request->all());        
        return redirect('pri-principalRemark')->with('flash_message_success', '<p>REMARK ADDED</p>');
        
    }

    public function principalApproval() 
    {        
        $sessions = Session::all();
        $classes = PriClass::all();
        $check = PriForPrincipal::count();
        $results = PriForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->get();
        
        return view('primary/principalApproval', compact('sessions','classes','results','check'));
    }

    public function postPrincipalApproval() 
    {   
        $copy = PriForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->get()->toArray();

        foreach ($copy as $c) 
        {
            PriFinalResult::create($c);
        };
        DB::table('pri_for_principals')->where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->delete();
        
        return redirect('pri-principalApproval')->with('flash_message_success', '<p>RESULT APPROVED</p>');
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
    //         return response(PriSubject::create($request->all()));
    //     }
    // }


    // Change Password


    public function showPassword(Request $request)
    {
        return view('primary/changePasword');
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
        $cteach = PriClass::all();

        return view('primary/studentResult', compact('sessions', 'cteach'));
    }

    public function getStudentResult()
    {
        $sessions = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $cteach = PriClass::all();
        $student = PriStudent::where(['student_id_num' => Input::get('regno')])->first();

        if(!$student)
        {
            abort(500);
        }
        $dob = $student->dob;
        $age = \Carbon::parse($dob)->age;
        $class = PriClass::where(['id' => Input::get('class_id')])->first();
        $test = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('test_score');
        $exam = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('total');
        }else {
            $total = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->id])->sum('final_cum');
        }
                
        $obt = DB::table('pri_final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = PriFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->get();
        $check = PriFinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->count();
        $tRemark = PriTeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();
        $pRemark = PriPrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->id])
            ->first();

        return view('primary/printResult', compact('sessions','term', 'cteach','dob','age','class', 'student','test','exam','total','obt','percent', 'results','check','tRemark','pRemark'));
    }

    public function select()
    {
        return view('select');
    }
}



