<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyClass;
use App\Subjectcombination;
use App\Student;
use App\Staff;
use App\Subject;
use App\User;
use App\Result;
use App\Role;
use App\ClassTeacher;
use App\SubjectTeacher;
use Auth;
use DB;
use App\Session;
use App\TeacherRemark;
use App\ForPrincipal;
use App\FinalResult;
use App\PrincipalRemark;
use Illuminate\Support\Facades\Input;
use App\Graduate;
 
class SubjectController extends Controller
{
    public function __construct()
    {
    	$this->middleware('web');
    }

    // For Staffs

    public function getmanageStaff()
    {

        $roles = Role::where('id', 1)->orwhere('id', 2)->orwhere('id', 3)->get();
        
        return view ('manageStaff',compact('roles'));
        
        
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

        return redirect('manageStaff')->with('flash_message_success','<h3>User Has Been Added</h3>');
        
    }

    public function getlistStaff()
    {
        $staffs = User::where('role_id', 1)->orwhere('role_id', 2)->orwhere('role_id', 3)->get();
        return view ('listStaff', compact('staffs'));
    }

    public function inactive()
    {
        $staffs = User::where('role_id', 1)->orwhere('role_id', 2)->orwhere('role_id', 3)->get();
        return view ('inactiveStaff', compact('staffs'));
    }

    public function getEditStaff($id)
    {
        $staff = User::findOrFail($id);
        $roles = Role::where('id', 1)->orwhere('id', 2)->orwhere('id', 3)->get();
        return view('editStaff', compact('roles', 'staff'));
    }

    public function postEditStaff(Request $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect('listStaff')->with('flash_message_success','<p>User Has Been Updated</p>');
    }

    public function deleteStaff($id=null)
    {
        User::where('id', $id)->delete();
        return redirect('listStaff')->with('flash_message_danger','<p>User Has Been Deleted</p>');
    }

    public function changestatus($id)
    {
        $staff=User::find($id);
        $staff->update([
            'active'=> $staff->active == true ? false : true
        ]);
        
        return redirect(route('listStaff'));
       
    }

    // For Classes
    
    public function getManageClass()
    {
        $classes = MyClass::all();
        
        return view ('manageClass', ['classes' => $classes]); 
    }

    public function postManageClass(Request $request)

    {
        MyClass::create($request->all());

        return redirect('manageClass')->with('flash_message_success','<p>Class Added</p>');
    }

    public function getEditClass($id)
    {
        $class = MyClass::findOrFail($id);
        return view('editClass', compact('class'));
    }

    public function postEditClass(Request $request, $id)
    {
        MyClass::findOrFail($id)->update($request->all());
        return redirect('manageClass')->with('flash_message_success','<p>Class Updated</p>');
    }

    public function deleteClass($id=null)
    {
        MyClass::where('class_id', $id)->delete();
        return redirect('manageClass')->with('flash_message_danger','<p>User Has Been Deleted</p>');
    }

    // For Sessions
    
    public function getManageSession()
    {
        $sessions = Session::all();
        
        return view ('manageSession', ['sessions' => $sessions]); 
    }

    public function postManageSession(Request $request)

    {
        Session::create($request->all());

        return redirect('manageSession')->with('flash_message_success','<p>Session Added</p>');
    }

    public function deleteSession($id=null)
    {
        Session::where('id', $id)->delete();
        return redirect('manageSession')->with('flash_message_danger','<p>Session Has Been Deleted</p>');
    }

    //For Students

    public function getmanageStudent()
    {
        $myClass = MyClass::all();
        $students = Student::orderBy('student_id','DESC')->get();
        
        return view('manageStudent', compact('myClass', 'students', ['students'=> $students]));
    }

    public function postManageStudent(Request $request)
    {
        $validatedData = $request->validate([
            'student_id_num' => 'unique:students',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Student::create($request->all());

        $student = new Student;

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
        
        return redirect('manageStudent')->with('flash_message_success','<p>Student Added</p>');
    }

    public function getlistStudent()
    {
        $students = Student::all();
        $classes = MyClass::all();
        
        return view ('listStudent', compact('students','classes', ['students'=> $students]));
    }

    public function viewStudent($id)
    {
        $student = Student::findOrFail($id);
        
        return view('viewStudent', compact('student'));
    }

    public function getEditStudent($id)
    {
        $student = Student::findOrFail($id);
        $classes = MyClass::all();
        return view('editStudent', compact('student','classes'));
    }

    public function postEditStudent(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        // Student::findOrFail($id)->update($request->all());
        $student = Student::findOrFail($id);

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
        // dd($student);
        $student->save();
        return redirect('listStudent')->with('flash_message_success','<p>Student Updated</p>');
    }

    public function deleteStudent($id=null)
    {
        Student::where('student_id', $id)->delete();
        return redirect('listStudent')->with('flash_message_danger','<p>Student Deleted</p>');
    }

    public function getlistGraduates()
    {
        $students = Graduate::all();
        $classes = MyClass::all();
        
        return view ('listGraduate', compact('students','classes', ['students'=> $students]));
    }

    public function viewGraduate($student_id)
    {
        $student = Graduate::where('student_id',$student_id);
        
        return view('viewStudent', compact('student'));
    }

    public function getpromoteStudent()
    {
        $students = Student::all();
        $classes = MyClass::all();
        
        return view ('promoteStudent', compact('students','classes', ['students'=> $students]));
    }

    public function promoteStudent(Request $request)
    {

        $bulk_options = $request['bulk_options'];
        $checkBoxArray = $request['checkBoxArray'];

        if($bulk_options == 'graduate'){
            $graduates = Student::whereIn('student_id',$checkBoxArray)->get()->toArray();
            foreach($graduates as $graduate){
                Graduate::insert($graduate);
            //     Student::destroy($graduate);
            }
            $deletes = Student::whereIn('student_id',$checkBoxArray)->get();
            // dd($deletes);
            foreach($deletes as $delete){
                // Graduate::insert($graduate);
                // Student::destroy($delete);
                Student::destroy(collect($delete));
            }
            return redirect('promoteStudent')->with('flash_message_success','<p>Students Graduated</p>');
        }else{
            Student::whereIn('student_id',$checkBoxArray)->update(['class_id' => $bulk_options]);
            return redirect('promoteStudent')->with('flash_message_success','<p>Student Promoted</p>');
        }
                    
                    
    }

    // For Suubjects

    public function getmanageSubject()
    {
        $subjects = Subject::all();
        
        return view('manageSubject', ['subjects' => $subjects]); 
    }

    public function postManageSubject(Request $request)
    {
        Subject::create($request->all());

        return redirect('manageSubject')->with('flash_message_success','<p>Subject Added</p>');
    }

    public function getEditSubject($id)
    {
        $subject = Subject::findOrFail($id);
        return view('editSubject', compact('subject'));
    }

    public function postEditSubject(Request $request, $id)
    {
        Subject::findOrFail($id)->update($request->all());
        return redirect('manageSubject')->with('flash_message_success','<p>Subject Updated</p>');
    }

    public function deleteSubject($id=null)
    {
        Subject::where('subject_id', $id)->delete();
        return redirect('manageSubject')->with('flash_message_danger','<p>Subject Deleted</p>');
    }

    public function getsubjectComb()
    {
        $myClass = MyClass::all();
        $subjects = Subject::all();
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
        $classes = MyClass::all();       
        $teachers = User::where('role_id', 2)->get();
        $classteachers = ClassTeacher::latest()->get();

        return view ('classTeacher', compact('classes', 'teachers', 'classteachers'));     
    }

    public function postClassTeacher(Request $request)

    {
        foreach($request->class_id as $key=>$val)
        {
            $test = ClassTeacher::create([
                'user_id' => $request->user_id[$key],
                'class_id' => $val,
            ]);        
        }

        return redirect('classTeacher')->with('flash_message_success','<h3>Class Teacher(s) Created Successfully</h3>');        
    }

    public function getEditCT($id)
    {
        $classes = MyClass::all();       
        $teachers = User::where('role_id', 2)->get();
        $ct = ClassTeacher::findOrFail($id);
        return view('editCT', compact('ct', 'classes', 'teachers'));
    }

    public function postEditCT(Request $request, $id)
    {
        ClassTeacher::findOrFail($id)->update($request->all());
        return redirect('classTeacher')->with('flash_message_success','<p>Class Teacher Updated</p>');
    }

    public function deleteCT($id=null)
    {
        ClassTeacher::where('id', $id)->delete();
        return redirect('classTeacher')->with('flash_message_danger','<p>Class Teacher Deleted</p>');
    }

    //For Subject Teacher

    public function getSubjectTeacher()
    {   

        $subjects = Subject::all(); 
        $teachers = User::where('role_id', 2)->get();
        $subjectteachers = SubjectTeacher::latest()->get();
        return view ('subjectTeacher', compact('subjects', 'teachers', 'subjectteachers'));        
        
    }

    public function postSubjectTeacher(Request $request)

    {
        foreach($request->subject_id as $key=>$val)
        {
            $test = SubjectTeacher::create([
                'user_id' => $request->user_id[$key],
                'subject_id' => $val,
            ]);          
            
        }

        return redirect('subjectTeacher')->with('flash_message_success','<h3>Subject Teacher(s) Created Successfully</h3>');        
    }

    public function getEditST($id)
    {
        $subjects = Subject::all(); 
        $teachers = User::where('role_id', 2)->get();
        $st = SubjectTeacher::findOrFail($id);
        return view('editST', compact('st', 'subjects', 'teachers'));
    }

    public function postEditST(Request $request, $id)
    {
        SubjectTeacher::findOrFail($id)->update($request->all());
        return redirect('subjectTeacher')->with('flash_message_success','<p>Subject Teacher Updated</p>');
    }

    public function deleteST($id=null)
    {
        SubjectTeacher::where('id', $id)->delete();
        return redirect('subjectTeacher')->with('flash_message_danger','<p>Subject Teacher Deleted</p>');
    }

    // Admin Check Student Result

    public function adminStudentResult()
    {
        $sessions = Session::all();
        $cteach = MyClass::all();

        return view('adminStudentResult', compact('sessions', 'cteach'));
    }

    public function adminGetStudentResult()
    {
        $sessions = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $cteach = MyClass::all();
        $student = Student::where(['student_id_num' => Input::get('regno')])->first();

        if(!$student)
        {
            abort(500);
        }

        $dob = $student->dob;
        $age = \Carbon::parse($dob)->age;
        $class = MyClass::where(['class_id' => Input::get('class_id')])->first();
        $test = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])->sum('test_score');
        $exam = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->student_id])->sum('total');
        }else {
            $total = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->student_id])->sum('final_cum');
        }

        $obt = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = FinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->get();
        $check = FinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->count();
        $tRemark = TeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->first();
        $pRemark = PrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->first();

        //     $data = ['title' => 'Student Result'];
        // $pdf = PDF::loadView('printResult', $data, compact('sessions', 'cteach','term','dob','age','class','tRemark','pRemark', 'student','test','exam','total','obt','percent', 'results','check'));
  
        // return $pdf->stream('result.pdf');

        return view('adminGetResult', compact('sessions', 'cteach','term','dob','age','class','tRemark','pRemark', 'student','test','exam','total','obt','percent', 'results','check'));
    }

    // Admin Delete Result
    public function adminDeleteResult($id=null)
    {
        FinalResult::where('id', $id)->delete();
        return back()->with('flash_message_danger','<p>Result Deleted</p>');
    }

    // For Results

    public function getmanageResult()
    {

        $myclass = MyClass::all();
        $sessions = Session::all();
        $subjects = SubjectTeacher::where(['user_id' => Auth::user()->id])->get();
        $results = Result::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->get();
        
        return view ('manageResult', compact('myclass', 'subjects', 'results', 'sessions'));
        
        
    }
    public function showStudents(Request $request) 
    {        
        if ($request->ajax())
        {
            return response(Student::where('class_id',$request->class_id)->get());
        }
    }

    public function postmanageResult(Request $request)
    {
        // Result::create($request->all());

        // $s = FinalResult::where('student_id',$request['student_id'])
        //     ->where('subject_id',$request['subject_id'])->first();

        // $a = DB::select('select total from final_results where subject_id =' . $request['subject_id'] .'and student_id =' . $request['student_id']);

            
        // $a = $e / 2;
        // dd($sum);
        $term = $request['term'];
        if($term == 'First Term')
        {
            Result::create([
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
            $last_total = DB::table('final_results')->select('total')->where(['student_id' => $request['student_id']])
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
                $grade = 'E';
                $remark = 'Pass';
            }
            else if ($sum >= 45 && $sum <=49){
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

            Result::create([
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
            $last_total2 = DB::table('final_results')->select('final_cum')->where(['student_id' => $request['student_id']])
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
                $grade = 'E';
                $remark = 'Pass';
            }
            else if ($sum2 >= 45 && $sum2 <=49){
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

            Result::create([
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
        

        return redirect('manageResult')->with('flash_message_success', '<p>Result Added</p>');
    }

    // public function getEditResult($id)
    // {
    //     $myclass = MyClass::all();
    //     $sessions = Session::all();
    //     $subjects = SubjectTeacher::where(['user_id' => Auth::user()->id])->get();
    //     $result = Result::findOrFail($id);
        
    //     return view('editResult', compact('result', 'subjects', 'myclass', 'session'));
    // }

    // public function postEditResult(Request $request, $id)
    // {
    //     Result::findOrFail($id)->update($request->all());
    //     return redirect('manageResult')->with('flash_message_success','<p>Result Updated</p>');
    // }

    public function deleteResult($id=null)
    {
        Result::where('id', $id)->delete();
        return redirect('manageResult')->with('flash_message_danger','<p>Result Deleted</p>');
    }

    public function readData()
    {
        $results = Result::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->get();
        // $results = Result::orderBy('result_id','DESC')->get();
        // dd($results); die();
        // return response($results);
        return view('resultList', compact('results'));
    }
    
    public function getcheckResult()
    {        
        $sessions = Session::all();
        $cteach = ClassTeacher::where(['user_id' => Auth::user()->id])->get();
        $stud = Student::where(['student_id' => Input::get('student_id')])->first();
        $ss = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $class = MyClass::where(['class_id' => Input::get('class_id')])->first();
        $test = DB::table('results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('test_score');
        $exam = DB::table('results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('total');
        }else {
            $total = DB::table('results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('final_cum');
        }
        
        $obt = DB::table('results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = Result::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->get();
        
        $pRemark = TeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->count();
        
        return view ('checkResult', compact('sessions', 'cteach','stud','ss','term','class', 'results', 'test', 'exam', 'total', 'obt','percent','pRemark'));
        
    }
    
    public function postTeacherRemark(Request $request)
    {        
        TeacherRemark::create($request->all());        
        return redirect ('checkResult')->with('flash_message_success', '<p>Your Remark have been added</p>');
        
    }

    public function showPercentage(Request $request) 
    {        
        if ($request->ajax())
        {
            return response(Result::where('student_id',$request->student_id)->get());
        }
    }

    public function showAllClassResult() 
    {        
        $sessions = Session::all();
        $cteach = ClassTeacher::where(['user_id' => Auth::user()->id])->first();
        $check = Result::count();
        
        return view('classResult', compact('sessions','cteach','check'));
    }


    public function ClassTeacherApproval() 
    {        
        // $sessions = Session::all();
        $cteach = ClassTeacher::where(['user_id' => Auth::user()->id])->first();
        $copy = Result::where('class_id', '=', $cteach->class_id )->get()->toArray();


        $count = ForPrincipal::where('user_id',  Auth::user()->id)
                        ->count();

        foreach ($copy as $c) 
        {
            ForPrincipal::create($c);
        };
        DB::table('results')->where('class_id', $cteach->class_id )->delete();

        return redirect('classResult')->with('flash_message_success', '<p>RESULTS APPROVED</p>');
    }
    
    public function getPrincipalRemark()
    {        
        $sessions = Session::all();
        $cteach = MyClass::all();
        $stud = Student::where(['student_id' => Input::get('student_id')])->first();
        $ss = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $class = MyClass::where(['class_id' => Input::get('class_id')])->first();
        $test = DB::table('for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('test_score');
        $exam = DB::table('for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('exam_score');
        
        if(Input::get('term') == 'First Term'){
            $total = DB::table('for_principals')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('total');
        }else {
            $total = DB::table('for_principals')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => Input::get('student_id')])->sum('final_cum');
        }
        
        $obt = DB::table('for_principals')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = ForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->get();
        
        $ctRemark = TeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->first();
        
        $pRemark = PrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => Input::get('student_id')])->count();

            // dd($pRemark); die();
        
        return view ('principalRemark', compact('sessions','ss','term','class', 'cteach', 'stud', 'results', 'ctRemark', 'pRemark', 'test', 'exam', 'total', 'obt','percent'));
        
    }
    
    public function postPrincipalRemark(Request $request)
    {        
        PrincipalRemark::create($request->all());        
        return redirect('principalRemark')->with('flash_message_success', '<p>REMARK ADDED</p>');
        
    }

    public function principalApproval() 
    {        
        $sessions = Session::all();
        $classes = MyClass::all();
        $check = ForPrincipal::count();
        $results = ForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->get();
        
        return view('principalApproval', compact('sessions','classes','results','check'));
    }

    public function postPrincipalApproval() 
    {   
        $copy = ForPrincipal::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->get()->toArray();

        foreach ($copy as $c) 
        {
            FinalResult::create($c);
        };
        DB::table('for_principals')->where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])->delete();
        
        return redirect('principalApproval')->with('flash_message_success', '<p>RESULT APPROVED</p>');
    }

    public function postcreateSubject(Request $request)
    {
       
        $subject_name = $request['subject_name'];
        $subject_code = $request['subject_code'];

        $manageSubject = new Subject();
        $manageSubject->subject_name = $subject_name;
        $manageSubject->subject_code = $subject_code;


        $manageSubject->save();

        return redirect()->back();

    }



    public function createSubject(Request $request)
    {
        if ($request->ajax())
        {
            return response(Subject::create($request->all()));
        }
    }


    // Check Student Result

    public function showStudentResult()
    {
        $sessions = Session::all();
        $cteach = MyClass::all();

        return view('studentResult', compact('sessions', 'cteach'));
    }

    public function getStudentResult()
    {
        $sessions = Session::where(['id' => Input::get('session_id')])->first();
        $term = Input::get('term');
        $cteach = MyClass::all();
        $student = Student::where(['student_id_num' => Input::get('regno')])->first();

        if(!$student)
        {
            abort(500);
        }

        $dob = $student->dob;
        $age = \Carbon::parse($dob)->age;
        $class = MyClass::where(['class_id' => Input::get('class_id')])->first();
        $test = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])->sum('test_score');
        $exam = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])->sum('exam_score');

        if(Input::get('term') == 'First Term'){
            $total = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->student_id])->sum('total');
        }else {
            $total = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
                ->where(['term' => Input::get('term')])
                ->where(['student_id' => $student->student_id])->sum('final_cum');
        }

        $obt = DB::table('final_results')->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])->sum('obt');
        if($total){
            $overall = ($total / $obt) * 100;
        }else {
            $overall = 0;
        }  
        $percent = round($overall, 2);
        $results = FinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->get();
        $check = FinalResult::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->count();
        $tRemark = TeacherRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->first();
        $pRemark = PrincipalRemark::where(['class_id' => Input::get('class_id')])
            ->where(['session_id' => Input::get('session_id')])
            ->where(['term' => Input::get('term')])
            ->where(['student_id' => $student->student_id])
            ->first();

        return view('printResult', compact('sessions', 'cteach','term','dob','age','class','tRemark','pRemark', 'student','test','exam','total','obt','percent', 'results','check'));
    }
}


