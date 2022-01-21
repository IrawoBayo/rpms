<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['as'=>'/','uses'=>'LoginController@getLogin']);
Route::post('/login',['as'=>'login','uses'=>'LoginController@postLogin']);


Route::get('/noPermission',function(){
	return view('permission.noPermission');
});

Route::group(['middleware'=>['authen']],function(){
	Route::get('/logout',['as'=>'logout','uses'=>'LoginController@getLogout']);
	Route::get('/dashboard',['as'=>'dashboard','uses'=>'DashboardController@dashboard']);
});


//////////////// Junior Secondary School /////////////////////////
Route::group(['middleware'=>['authen','roles'],'roles'=>['admin']],function(){

    // For Staff

    Route::get('/manageStaff', [
    'uses' => 'SubjectController@getmanageStaff',
    'as' => 'manageStaff'

    ]);

    Route::post('/manageStaff',[
        'uses'=>'SubjectController@postmanageStaff',
        'as'=>'manageStaff'
    ]);

    Route::get('/listStaff', [
    'uses' => 'SubjectController@getlistStaff',
    'as' => 'listStaff'

    ]);

    Route::get('/editStaff/{id}', 'SubjectController@getEditStaff');

    Route::post('/editStaff/{id}', 'SubjectController@postEditStaff');

    Route::match(['get','post'],'/deleteStaff/{id}', 'SubjectController@deleteStaff');

    // For Class

    Route::get('/manageClass', [
    'uses' => 'SubjectController@getmanageClass',
    'as' => 'manageClass'

    ]);

    Route::post('/manageClass',[
        'uses'=>'SubjectController@postmanageClass',
        'as'=>'manageClass'
    ]);

    Route::get('/editClass/{id}', 'SubjectController@getEditClass');

    Route::post('/editClass/{id}', 'SubjectController@postEditClass');

    Route::match(['get','post'],'/deleteClass/{id}', 'SubjectController@deleteClass');

    // For Session

    Route::get('/manageSession', [
        'uses' => 'SubjectController@getmanageSession',
        'as' => 'manageSession'
    
        ]);
    
        Route::post('/manageSession',[
            'uses'=>'SubjectController@postmanageSession',
            'as'=>'manageSession'
        ]);
    
        Route::match(['get','post'],'/deleteSession/{id}', 'SubjectController@deleteSession');

    // For Student

    Route::get('/manageStudent', [
        'uses' => 'SubjectController@getmanageStudent',
        'as' => 'manageStudent'
    
    ]);

    Route::post('/manageStudent',[
        'uses'=>'SubjectController@postmanageStudent',
        'as'=>'manageStudent'
    ]);

    Route::get('/listStudent', [
        'uses' => 'SubjectController@getlistStudent',
        'as' => 'listStudent'
    ]);

    Route::get('/viewStudent/{id}', 'SubjectController@viewStudent');

    Route::get('/editStudent/{id}', 'SubjectController@getEditStudent');

    Route::post('/editStudent/{id}', 'SubjectController@postEditStudent');

    Route::match(['get','post'],'/deleteStudent/{id}', 'SubjectController@deleteStudent');

    Route::get('/listGraduates', [
        'uses' => 'SubjectController@getlistGraduates',
        'as' => 'listGraduates'
    ]);

    Route::get('/viewGraduate/{id}', 'SubjectController@viewGraduate');

    Route::get('/promoteStudent', 'SubjectController@getpromoteStudent');

    Route::post('/promoteStudent', 'SubjectController@promoteStudent');


    // For Subjects

	Route::get('/manageSubject', [
        'uses' => 'SubjectController@getmanageSubject',
        'as' => 'manageSubject'
    ]);

    Route::post('/manageSubject',[
        'uses'=>'SubjectController@postmanageSubject',
        'as'=>'manageSubject'
    ]);
    
    Route::get('/editSubject/{id}', 'SubjectController@getEditSubject');

    Route::post('/editSubject/{id}', 'SubjectController@postEditSubject');

    Route::match(['get','post'],'/deleteSubject/{id}', 'SubjectController@deleteSubject');


    Route::get('/subjectComb', [
    'uses' => 'SubjectController@getsubjectComb',
    'as' => 'subjectComb'

    ]);

    Route::post('/subjectComb',[
        'uses'=>'SubjectController@postSubjectcombination',
        'as'=>'subjectComb'
    ]);

    // For Class Teacher
    Route::get('/classTeacher', [
        'uses' => 'SubjectController@getClassTeacher',
        'as' => 'classTeacher'    
    ]);

    Route::post('/classTeacher',[
        'uses'=>'SubjectController@postClassTeacher',
        'as'=>'classTeacher'
    ]);
    
    Route::get('/editCT/{id}', 'SubjectController@getEditCT');

    Route::post('/editCT/{id}', 'SubjectController@postEditCT');

    Route::match(['get','post'],'/deleteCT/{id}', 'SubjectController@deleteCT');

    // For Subject Teacher

    Route::get('/subjectTeacher', [
        'uses' => 'SubjectController@getSubjectTeacher',
        'as' => 'subjectTeacher'    
    ]);

    Route::post('/subjectTeacher',[
        'uses'=>'SubjectController@postSubjectTeacher',
        'as'=>'subjectTeacher'
    ]);
    
    Route::get('/editST/{id}', 'SubjectController@getEditST');

    Route::post('/editST/{id}', 'SubjectController@postEditST');

    Route::match(['get','post'],'/deleteST/{id}', 'SubjectController@deleteST');

	// Route::get('/manage/subject',['as'=>'manageSubject','uses'=>'SubjectController@getManageSubject']);

	// Route::post('/manage/subject/insert',['as'=>'postInsertAcademic','uses'=>'SubjectController@postInsertAcademic']);

	// Route::post('/manage/subject/insert-program',['as'=>'postInsertProgram','uses'=>'SubjectController@postInsertProgram']);

	// Route::post('/manage/subject/insert-level',['as'=>'postInsertLevel','uses'=>'SubjectController@postInsertLevel']);

	// Route::post('/manage/subject/insert-term',['as'=>'postInsertTerm','uses'=>'SubjectController@postInsertTerm']);

	

	// Route::get('/manage/subject/showLevel',['as'=>'showLevel','uses'=>'SubjectController@showLevel']);

	// Route::post('/manage/subject/insert-time',['as'=>'postInsertTime','uses'=>'SubjectController@postInsertTime']);


	Route::post('/manage/subject/subject',['as'=>'createSubject','uses'=>'SubjectController@createSubject']);


    // Admin Check Student Result
    Route::get('/adminStudentResult', 'SubjectController@adminStudentResult');
    Route::get('/adminGetStudentResult', 'SubjectController@adminGetStudentResult');
    Route::match(['get','post'],'/adminDeleteResult/{id}', 'SubjectController@adminDeleteResult');

	

});

// Get Student from class id

Route::get('/manageResult/showStudents', [
    'uses' => 'SubjectController@showStudents',
    'as' => 'showStudents'        
]);

Route::group(['middleware'=>['authen','roles'],'roles'=>['Teacher']],function(){
    Route::get('/manageResult', [
        'uses' => 'SubjectController@getmanageResult',
        'as' => 'manageResult'        
    ]);

    Route::post('/manageResult', [
        'uses' => 'SubjectController@postmanageResult',
        'as' => 'manageResult'
    
    ]);
    
    Route::get('/editResult/{id}', 'SubjectController@getEditResult');

    Route::post('/editResult/{id}', 'SubjectController@postEditResult');

    Route::match(['get','post'],'/deleteResult/{id}', 'SubjectController@deleteResult');

    Route::get('/manageResult/readData', [
        'uses' => 'SubjectController@readData',
        'as' => 'manageResult/readData'        
    ]);
    
    Route::get('/checkResult', [
        'uses' => 'SubjectController@getcheckResult',
        'as' => 'checkResult'    
    ]);
    
    Route::post('/checkResult', [
        'uses' => 'SubjectController@postTeacherRemark',
        'as' => 'checkResult'    
    ]);
    
    Route::get('/classResult', [
        'uses' => 'SubjectController@showAllClassResult',
        'as' => 'classResult'    
    ]);    
    
    Route::get('/teacherApproval', [
        'uses' => 'SubjectController@ClassTeacherApproval',
        'as' => 'teacherApproval'    
    ]);
});

Route::group(['middleware'=>['authen','roles'],'roles'=>['Principal']],function(){
    Route::get('/principalApproval', [
        'uses' => 'SubjectController@principalApproval',
        'as' => 'principalApproval'    
        ]);  

    Route::post('/principalApproval', [
        'uses' => 'SubjectController@postPrincipalApproval',
        'as' => 'principalApproval'    
        ]);
    
    Route::get('/principalRemark', [
        'uses' => 'SubjectController@getPrincipalRemark',
        'as' => 'principalRemark'    
    ]);
    
    Route::post('/principalRemark', [
        'uses' => 'SubjectController@postPrincipalRemark',
        'as' => 'principalRemark'    
    ]);
});



//////////////// Senior Secondary School /////////////////////////
Route::group(['middleware'=>['authen','roles'],'roles'=>['ssAdmin']],function(){

    // For Staff

    Route::get('/ss-manageStaff', [
       'uses' => 'SeniorController@getmanageStaff',
       'as' => 'ss-manageStaff'
   
   ]);

   Route::post('/ss-manageStaff',[
       'uses'=>'SeniorController@postmanageStaff',
       'as'=>'ss-manageStaff'
   ]);

   Route::get('/ss-listStaff', [
   'uses' => 'SeniorController@getlistStaff',
   'as' => 'ss-listStaff'

   ]);

   Route::get('/ss-editStaff/{id}', 'SeniorController@getEditStaff');

   Route::post('/ss-editStaff/{id}', 'SeniorController@postEditStaff');

   Route::match(['get','post'],'/ss-deleteStaff/{id}', 'SeniorController@deleteStaff');

   // For Class

   Route::get('/ss-manageClass', [
   'uses' => 'SeniorController@getmanageClass',
   'as' => 'ss-manageClass'

   ]);

   Route::post('/ss-manageClass',[
       'uses'=>'SeniorController@postmanageClass',
       'as'=>'ss-manageClass'
   ]);

   Route::get('/ss-editClass/{id}', 'SeniorController@getEditClass');

   Route::post('/ss-editClass/{id}', 'SeniorController@postEditClass');

   Route::match(['get','post'],'/ss-deleteClass/{id}', 'SeniorController@deleteClass');

   // For Student

   Route::get('/ss-manageStudent', [
       'uses' => 'SeniorController@getmanageStudent',
       'as' => 'ss-manageStudent'
   
   ]);

   Route::post('/ss-manageStudent',[
       'uses'=>'SeniorController@postmanageStudent',
       'as'=>'ss-manageStudent'
   ]);

   Route::get('/ss-listStudent', [
       'uses' => 'SeniorController@getlistStudent',
       'as' => 'ss-listStudent'
   ]);

   Route::get('/ss-viewStudent/{id}', 'SeniorController@viewStudent');

   Route::get('/ss-editStudent/{id}', 'SeniorController@getEditStudent');

   Route::post('/ss-editStudent/{id}', 'SeniorController@postEditStudent');

   Route::match(['get','post'],'/ss-deleteStudent/{id}', 'SeniorController@deleteStudent');

   Route::get('/ss-listGraduates', [
       'uses' => 'SeniorController@getlistGraduates',
       'as' => 'ss-listGraduates'
   ]);

   Route::get('/ss-viewGraduate/{id}', 'SeniorController@viewGraduate');

   Route::get('/ss-promoteStudent', 'SeniorController@getpromoteStudent');

   Route::post('/ss-promoteStudent', 'SeniorController@promoteStudent');


   // For Subjects

   Route::get('/ss-manageSubject', [
       'uses' => 'SeniorController@getmanageSubject',
       'as' => 'ss-manageSubject'
   ]);

   Route::post('/ss-manageSubject',[
       'uses'=>'SeniorController@postmanageSubject',
       'as'=>'ss-manageSubject'
   ]);
   
   Route::get('/ss-editSubject/{id}', 'SeniorController@getEditSubject');

   Route::post('/ss-editSubject/{id}', 'SeniorController@postEditSubject');

   Route::match(['get','post'],'/ss-deleteSubject/{id}', 'SeniorController@deleteSubject');


   Route::get('/ss-subjectComb', [
   'uses' => 'SeniorController@getsubjectComb',
   'as' => 'ss-subjectComb'

   ]);

   Route::post('/ss-subjectComb',[
       'uses'=>'SeniorController@postSubjectcombination',
       'as'=>'ss-subjectComb'
   ]);

   // For Class Teacher
   Route::get('/ss-classTeacher', [
       'uses' => 'SeniorController@getClassTeacher',
       'as' => 'ss-classTeacher'    
   ]);

   Route::post('/ss-classTeacher',[
       'uses'=>'SeniorController@postClassTeacher',
       'as'=>'ss-classTeacher'
   ]);
   
   Route::get('/ss-editCT/{id}', 'SeniorController@getEditCT');

   Route::post('/ss-editCT/{id}', 'SeniorController@postEditCT');

   Route::match(['get','post'],'/ss-deleteCT/{id}', 'SeniorController@deleteCT');

   // For Subject Teacher

   Route::get('/ss-subjectTeacher', [
       'uses' => 'SeniorController@getSubjectTeacher',
       'as' => 'ss-subjectTeacher'    
   ]);

   Route::post('/ss-subjectTeacher',[
       'uses'=>'SeniorController@postSubjectTeacher',
       'as'=>'ss-subjectTeacher'
   ]);
   
   Route::get('/ss-editST/{id}', 'SeniorController@getEditST');

   Route::post('/ss-editST/{id}', 'SeniorController@postEditST');

   Route::match(['get','post'],'/ss-deleteST/{id}', 'SeniorController@deleteST');

   // Route::get('/manage/subject',['as'=>'manageSubject','uses'=>'SeniorController@getManageSubject']);

   // Route::post('/manage/subject/insert',['as'=>'postInsertAcademic','uses'=>'SeniorController@postInsertAcademic']);

   // Route::post('/manage/subject/insert-program',['as'=>'postInsertProgram','uses'=>'SeniorController@postInsertProgram']);

   // Route::post('/manage/subject/insert-level',['as'=>'postInsertLevel','uses'=>'SeniorController@postInsertLevel']);

   // Route::post('/manage/subject/insert-term',['as'=>'postInsertTerm','uses'=>'SeniorController@postInsertTerm']);

   

   // Route::get('/manage/subject/showLevel',['as'=>'showLevel','uses'=>'SeniorController@showLevel']);

   // Route::post('/manage/subject/insert-time',['as'=>'postInsertTime','uses'=>'SeniorController@postInsertTime']);


   Route::post('/ss-manage/subject/subject',['as'=>'createSubject','uses'=>'SeniorController@createSubject']);


    // Admin Check Student Result
    Route::get('/ss-adminStudentResult', 'SeniorController@adminStudentResult');
    Route::get('/ss-adminGetStudentResult', 'SeniorController@adminGetStudentResult');
    Route::match(['get','post'],'/ss-adminDeleteResult/{id}', 'SeniorController@adminDeleteResult');
   

});

Route::get('/ss-manageResult/showStudents', [
   'uses' => 'SeniorController@showStudents',
   'as' => 'ss-showStudents'        
]);

Route::group(['middleware'=>['authen','roles'],'roles'=>['ssTeacher']],function(){
   Route::get('/ss-manageResult', [
       'uses' => 'SeniorController@getmanageResult',
       'as' => 'ss-manageResult'        
   ]);

   Route::post('/ss-manageResult', [
       'uses' => 'SeniorController@postmanageResult',
       'as' => 'ss-manageResult'
   
   ]);
   
   Route::get('/ss-editResult/{id}', 'SeniorController@getEditResult');

   Route::post('/ss-editResult/{id}', 'SeniorController@postEditResult');

   Route::match(['get','post'],'/ss-deleteResult/{id}', 'SeniorController@deleteResult');

   Route::get('/ss-manageResult/readData', [
       'uses' => 'SeniorController@readData',
       'as' => 'ss-manageResult/readData'        
   ]);
   
   Route::get('/ss-checkResult', [
       'uses' => 'SeniorController@getcheckResult',
       'as' => 'ss-checkResult'    
   ]);
   
   Route::post('/ss-checkResult', [
       'uses' => 'SeniorController@postTeacherRemark',
       'as' => 'ss-checkResult'    
   ]);
   
   Route::get('/ss-classResult', [
       'uses' => 'SeniorController@showAllClassResult',
       'as' => 'ss-classResult'    
   ]);    
   
   Route::get('/ss-teacherApproval', [
       'uses' => 'SeniorController@ClassTeacherApproval',
       'as' => 'ss-teacherApproval'    
   ]);
});

Route::group(['middleware'=>['authen','roles'],'roles'=>['ssPrincipal']],function(){
   Route::get('/ss-principalApproval', [
       'uses' => 'SeniorController@principalApproval',
       'as' => 'ss-principalApproval'    
       ]);  

   Route::post('/ss-principalApproval', [
       'uses' => 'SeniorController@postPrincipalApproval',
       'as' => 'ss-principalApproval'    
       ]);
   
   Route::get('/ss-principalRemark', [
       'uses' => 'SeniorController@getPrincipalRemark',
       'as' => 'ss-principalRemark'    
   ]);
   
   Route::post('/ss-principalRemark', [
       'uses' => 'SeniorController@postPrincipalRemark',
       'as' => 'ss-principalRemark'    
   ]);
});



//////////////// Primary School /////////////////////////
Route::group(['middleware'=>['authen','roles'],'roles'=>['priAdmin']],function(){

	 // For Staff

     Route::get('/pri-manageStaff', [
        'uses' => 'PrimaryController@getmanageStaff',
        'as' => 'pri-manageStaff'
    
    ]);

    Route::post('/pri-manageStaff',[
        'uses'=>'PrimaryController@postmanageStaff',
        'as'=>'pri-manageStaff'
    ]);

    Route::get('/pri-listStaff', [
    'uses' => 'PrimaryController@getlistStaff',
    'as' => 'pri-listStaff'

    ]);

    Route::get('/pri-editStaff/{id}', 'PrimaryController@getEditStaff');

    Route::post('/pri-editStaff/{id}', 'PrimaryController@postEditStaff');

    Route::match(['get','post'],'/pri-deleteStaff/{id}', 'PrimaryController@deleteStaff');

    // For Class

    Route::get('/pri-manageClass', [
    'uses' => 'PrimaryController@getmanageClass',
    'as' => 'pri-manageClass'

    ]);

    Route::post('/pri-manageClass',[
        'uses'=>'PrimaryController@postmanageClass',
        'as'=>'pri-manageClass'
    ]);

    Route::get('/pri-editClass/{id}', 'PrimaryController@getEditClass');

    Route::post('/pri-editClass/{id}', 'PrimaryController@postEditClass');

    Route::match(['get','post'],'/pri-deleteClass/{id}', 'PrimaryController@deleteClass');

    // For Student

    Route::get('/pri-manageStudent', [
        'uses' => 'PrimaryController@getmanageStudent',
        'as' => 'pri-manageStudent'
    
    ]);

    Route::post('/pri-manageStudent',[
        'uses'=>'PrimaryController@postmanageStudent',
        'as'=>'pri-manageStudent'
    ]);

    Route::get('/pri-listStudent', [
        'uses' => 'PrimaryController@getlistStudent',
        'as' => 'pri-listStudent'
    ]);

    Route::get('/pri-viewStudent/{id}', 'PrimaryController@viewStudent');

    Route::get('/pri-editStudent/{id}', 'PrimaryController@getEditStudent');

    Route::post('/pri-editStudent/{id}', 'PrimaryController@postEditStudent');

    Route::match(['get','post'],'/pri-deleteStudent/{id}', 'PrimaryController@deleteStudent');

    Route::get('/pri-listGraduates', [
        'uses' => 'PrimaryController@getlistGraduates',
        'as' => 'pri-listGraduates'
    ]);

    Route::get('/pri-viewGraduate/{id}', 'PrimaryController@viewGraduate');

    Route::get('/pri-promoteStudent', 'PrimaryController@getpromoteStudent');

    Route::post('/pri-promoteStudent', 'PrimaryController@promoteStudent');


    // For Subjects

    Route::get('/pri-manageSubject', [
        'uses' => 'PrimaryController@getmanageSubject',
        'as' => 'pri-manageSubject'
    ]);

    Route::post('/pri-manageSubject',[
        'uses'=>'PrimaryController@postmanageSubject',
        'as'=>'pri-manageSubject'
    ]);
    
    Route::get('/pri-editSubject/{id}', 'PrimaryController@getEditSubject');

    Route::post('/pri-editSubject/{id}', 'PrimaryController@postEditSubject');

    Route::match(['get','post'],'/pri-deleteSubject/{id}', 'PrimaryController@deleteSubject');


    Route::get('/pri-subjectComb', [
    'uses' => 'PrimaryController@getsubjectComb',
    'as' => 'pri-subjectComb'

    ]);

    Route::post('/pri-subjectComb',[
        'uses'=>'PrimaryController@postSubjectcombination',
        'as'=>'pri-subjectComb'
    ]);

    // For Class Teacher
    Route::get('/pri-classTeacher', [
        'uses' => 'PrimaryController@getClassTeacher',
        'as' => 'pri-classTeacher'    
    ]);

    Route::post('/pri-classTeacher',[
        'uses'=>'PrimaryController@postClassTeacher',
        'as'=>'pri-classTeacher'
    ]);
    
    Route::get('/pri-editCT/{id}', 'PrimaryController@getEditCT');

    Route::post('/pri-editCT/{id}', 'PrimaryController@postEditCT');

    Route::match(['get','post'],'/pri-deleteCT/{id}', 'PrimaryController@deleteCT');

    // For Subject Teacher

    Route::get('/pri-subjectTeacher', [
        'uses' => 'PrimaryController@getSubjectTeacher',
        'as' => 'pri-subjectTeacher'    
    ]);

    Route::post('/pri-subjectTeacher',[
        'uses'=>'PrimaryController@postSubjectTeacher',
        'as'=>'pri-subjectTeacher'
    ]);
    
    Route::get('/pri-editST/{id}', 'PrimaryController@getEditST');

    Route::post('/pri-editST/{id}', 'PrimaryController@postEditST');

    Route::match(['get','post'],'/pri-deleteST/{id}', 'PrimaryController@deleteST');

    // Route::get('/manage/subject',['as'=>'manageSubject','uses'=>'PrimaryController@getManageSubject']);

    // Route::post('/manage/subject/insert',['as'=>'postInsertAcademic','uses'=>'PrimaryController@postInsertAcademic']);

    // Route::post('/manage/subject/insert-program',['as'=>'postInsertProgram','uses'=>'PrimaryController@postInsertProgram']);

    // Route::post('/manage/subject/insert-level',['as'=>'postInsertLevel','uses'=>'PrimaryController@postInsertLevel']);

    // Route::post('/manage/subject/insert-term',['as'=>'postInsertTerm','uses'=>'PrimaryController@postInsertTerm']);

    

    // Route::get('/manage/subject/showLevel',['as'=>'showLevel','uses'=>'PrimaryController@showLevel']);

    // Route::post('/manage/subject/insert-time',['as'=>'postInsertTime','uses'=>'PrimaryController@postInsertTime']);


    Route::post('/pri-manage/subject/subject',['as'=>'createSubject','uses'=>'PrimaryController@createSubject']);


    // Admin Check Student Result
    Route::get('/pri-adminStudentResult', 'PrimaryController@adminStudentResult');
    Route::get('/pri-adminGetStudentResult', 'PrimaryController@adminGetStudentResult');
    Route::match(['get','post'],'/pri-adminDeleteResult/{id}', 'PrimaryController@adminDeleteResult');
	

});

Route::get('/pri-manageResult/showStudents', [
    'uses' => 'PrimaryController@showStudents',
    'as' => 'pri-showStudents'        
]);

Route::group(['middleware'=>['authen','roles'],'roles'=>['PriTeacher']],function(){
    Route::get('/pri-manageResult', [
        'uses' => 'PrimaryController@getmanageResult',
        'as' => 'pri-manageResult'        
    ]);

    Route::post('/pri-manageResult', [
        'uses' => 'PrimaryController@postmanageResult',
        'as' => 'pri-manageResult'
    
    ]);
    
    Route::get('/pri-editResult/{id}', 'PrimaryController@getEditResult');

    Route::post('/pri-editResult/{id}', 'PrimaryController@postEditResult');

    Route::match(['get','post'],'/pri-deleteResult/{id}', 'PrimaryController@deleteResult');

    Route::get('/pri-manageResult/readData', [
        'uses' => 'PrimaryController@readData',
        'as' => 'pri-manageResult/readData'        
    ]);
    
    Route::get('/pri-checkResult', [
        'uses' => 'PrimaryController@getcheckResult',
        'as' => 'pri-checkResult'    
    ]);
    
    Route::post('/pri-checkResult', [
        'uses' => 'PrimaryController@postTeacherRemark',
        'as' => 'pri-checkResult'    
    ]);
    
    Route::get('/pri-classResult', [
        'uses' => 'PrimaryController@showAllClassResult',
        'as' => 'pri-classResult'    
    ]);    
    
    Route::get('/pri-teacherApproval', [
        'uses' => 'PrimaryController@ClassTeacherApproval',
        'as' => 'pri-teacherApproval'    
    ]);
});

Route::group(['middleware'=>['authen','roles'],'roles'=>['Head Master/Mistress']],function(){
    Route::get('/pri-principalApproval', [
        'uses' => 'PrimaryController@principalApproval',
        'as' => 'pri-principalApproval'    
        ]);  

    Route::post('/pri-principalApproval', [
        'uses' => 'PrimaryController@postPrincipalApproval',
        'as' => 'pri-principalApproval'    
        ]);
    
    Route::get('/pri-principalRemark', [
        'uses' => 'PrimaryController@getPrincipalRemark',
        'as' => 'pri-principalRemark'    
    ]);
    
    Route::post('/pri-principalRemark', [
        'uses' => 'PrimaryController@postPrincipalRemark',
        'as' => 'pri-principalRemark'    
    ]);
});

//For Password Update
Route::get('/change-password', 'PrimaryController@showPassword');
Route::post('/change-password', 'PrimaryController@updatePassword');

//For Junior Secondary School
Route::get('/studentResult', 'SubjectController@showStudentResult');
Route::get('/getStudentResult', 'SubjectController@getStudentResult');

//For Primary School
Route::get('/pri-studentResult', 'PrimaryController@showStudentResult');
Route::get('/pri-getStudentResult', 'PrimaryController@getStudentResult');

//For Senior Secondary School
Route::get('/ss-studentResult', 'SeniorController@showStudentResult');
Route::get('/ss-getStudentResult', 'SeniorController@getStudentResult');

//Select
Route::get('/select-school', 'PrimaryController@select');