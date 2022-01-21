<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers; 
    protected $username = 'username';   
    protected $redirectTo = '/dashboard';
    protected $guard='web';

    public function getLogin()
    {
    	if (Auth::guard('web')->check())
    		{
    			return redirect()->route('dashboard');
    		}

    		return view('login');
    }
    public function postLogin(Request $request)

    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

    	$auth = Auth::guard('web')->attempt(['username'=>$request->username,'password'=>$request->password,'active'=>1]);

    	if ($auth)
    	{
    		return redirect()->route('dashboard');
    	}

    	return redirect()->route('/')->with('flash_message_danger','<p> Account blocked or Record not found, contact the admin for help</p>');
    }

    public function getLogout()
    {
    	Auth::guard('web')->logout();
    	return redirect()->route('/');
    }
}
