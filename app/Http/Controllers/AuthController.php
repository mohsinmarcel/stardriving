<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use URL;
use Session;
class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'string','min:5','max:100'],
            'password' => ['required'],
        ]);
        $admin = Admin::where('email',$request->email)->orWhere('username', $request->email)->first();
        if($admin == null){
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        if(!$admin->active){
            return back()->withErrors([
                'email' => 'Your account is deactivated by admin.',
            ]);
            
        }
        Auth::login($admin, $request->has('remember'));

        $request->session()->regenerate();
    
        return redirect()->intended('dashboard');
    }
    public function forgetPassword()
    {
        return view('auth.forgetPassword');
    }

    public function forgetPasswordPost(Request $request)
    {
        // 
        // dd($request->all());
        $admin = Admin::where('email',$request->email)->first();
        // if ($request->email=="info@stardrivingschool.ca") {
        if($admin){
            $admin->remember_token = md5(rand(10,1000000));
            $admin->save();
            $details = [
                'title' => 'Password Change Request Verification',
                'token' => $admin->remember_token
            ];
        
            Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
            Session::flash('Success', 'Email has been sent to you, please verify it'); 
        }else{
            Session::flash('Error', 'There is no data with this Email.'); 
        }
        return redirect()->route('login');
    }
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:200',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|required_with:old_password|confirmed|min:6',
        ]);
        if ($validator->passes()) {
            $user_data = [];
            if($request->has('new_password') && $request->new_password != ''){
                if(!Hash::check($request->old_password, Auth::user()->password))
                {
                    $validator->getMessageBag()->add('password', 'Old Password doesn\'t matched');
                    return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
                }
                $user_data['password'] = Hash::make($request->new_password);
            }   

            if($request->has('username') && $request->username != ''){
                $user_data['email'] = $request->username;
            }
            Auth::user()->update($user_data);
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }

    public function changePassword2($token)
    {
        $admin = Admin::where('remember_token',$token)->first();
        if($admin){
            return view('auth.changePassword', compact("token"));
        }
        Session::flash('Error', 'Token has been expired, please request again'); 
        return redirect()->route('login');
    }

    public function changePassword2Post($token, Request $request)
    {
        $admin = Admin::where('remember_token',$token)->first();
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|min:6',
        ]);
        if ($validator->passes()) {
            $user_data = [];
            if($request->has('newPassword') && $request->newPassword != ''){
                $admin->password = Hash::make($request->newPassword);
                $admin->remember_token = null;
            }
            $admin->save();
            Session::flash('Success', 'Password has change now login with new password'); 
            return redirect()->route('login');
        }
    }
}
