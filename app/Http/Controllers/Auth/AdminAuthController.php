<?php

namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Admin;
 
class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin',['except' => ['doLogin','showLoginForm','createAdminUser']]);
    }
 
    public function showLoginForm() {
        return view('admin.auth.login');
    }
    
    public function doLogin(Request $request) {
        //validate the form data
        // dd($request);    
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attempt to login the admins in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            //if successful redirect to admin dashboard
            return redirect('admin/dashboard');
        }
        //if unsuccessfull redirect back to the login for with form data
        return Redirect::to('admin/login')
                    ->withErrors(['failedLogin'=>'Email or Password was incorrect'])
                    ->withInput(Input::except('password'));
    }
 
    public function doLogout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect('/');
    }

    public function createAdminUser($email, $password){

        $adminData = array(
            'email' 	=> $email,
            'password' 	=> bcrypt($password)
        );

        $newAdmin = new Admin();
        $newAdmin->email = $email;
        $newAdmin->password = bcrypt($password);
        $newAdmin->save();
    }
 
}