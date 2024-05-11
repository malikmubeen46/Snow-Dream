<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->passes()) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if(Auth::attempt($request->only('email','password'))){
                return view('home');
            }
        }

        return redirect()->back()->withErrors($validator);
    }

    
    public function admin_login(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $email = $request->email;
            $password = md5($request->password);

            $user = DB::table('admin')->where([
                ['email', $email],
                ['password', $password]
            ])->first();

            if($user){
                setcookie('admin', $password, time() + (86400), "/");
                return redirect('admin/home');
            }else{
                return back()->with('admin_error',"User name or password not correct!");
            }
        }else{
            return view('admin/login');
        }
    }

    public function admin_logout(){
        setcookie('admin', 'logout', time() - 100, "/");
        return redirect('admin');
    }

    public function admin_home(){
        $users = User::all();
        return view('admin/home')->with('users', $users);
    }

    public function edit_user(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:6'
            ]);

            $user = User::find($request->id);
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
    
                return back()->with('success','Profile updated successfully');
            }else{
                return back()->with('error','Invalid Details');
            }
        }else{
            $user = User::find($request->id);
            return view('admin/edit_user')->with('user', $user);
        }
    }

    public function delete_user(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            $remember_me = false;
            if(isset($request->remember_me)){
                $remember_me = true;
            }
            $user = Auth::attempt($request->only('email','password'),  $remember_me);

            if($user){
                return view('home');
            }else{
                return redirect('/')->with('error','Something went wrong');
            }
        }

        return redirect()->back()->withErrors($validator);
    }


    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('/')->with('success','Your are Logged out successfully');
    }

    public function profile(){
        if(auth()->user()){
            return view('profile');
        }else{
            return redirect('/');
        }
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6'
        ]);
        
        $fileName = '';
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME);
            $file->move('uploads', $fileName);
        }

        $user = User::where('id', auth()->user()->id)->first();
        // dd($user->toArray());

        if ($user) {
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'image' => $fileName
            ]);

            Auth::login($user);

            return back()->with('success','Profile updated successfully');
        }else{
            return back()->with('error','Invalid Details');
        }
    }
}
