<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function redirectToProvider()
    {

    $scopes = [
    'https://www.googleapis.com/auth/calendar'
    ];

    $parameters = ['access_type' => 'offline'];

    return Socialite::driver('google')->scopes($scopes)->with($parameters)->redirect();

    }

    public function handleProviderCallback(Request $request)
    {
//        $scopes = [
//            'https://www.googleapis.com/auth/calendar'
//        ];
//        $parameters = ['access_type' => 'offline'];
//
//        $user =  Socialite::driver('google')->scopes($scopes)->with($parameters)->user();
//
//        dd($user);
//        return $user->refreshToken;

        $access_token = Socialite::driver('google')->getAccessTokenResponse($request->code);
        $gUser = Socialite::driver('google')->userFromToken($access_token['access_token']);
        session_start();
        $_SESSION['access_token'] = $access_token;
        $gEmail = str_replace('@ucsc.cmb.ac.lk','',$gUser->email);

        if($user = User::whereEmail($gEmail)->first()){

            if($user->is_active==1){

                $user->name = $gUser->name;
                $user->avatar = $gUser->avatar;
                $user->token = $gUser->token;
                if($gUser->refreshToken){
                    $user->refresh_token = $gUser->refreshToken;
                }
                if($gUser->refreshToken){
                    $user->refresh_token = $gUser->refreshToken;
                }

                if($code =  $request->code){
                    $user->access_token = $access_token['access_token'];
                }

                $user->update();


                Auth::login($user,true);
                return redirect('home');

            }else{
                return redirect('/login')->withErrors(['Your account has been disabled. Please contact Admin.']);
            }
        }else{
            return redirect('/login')->withErrors(['Access denied. Your email account doesn\'t match with our records. Please request a user account from admin.']);
        }

    }

    public function index(){

        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function create(){

        $roles = Role::all()->pluck('name','id');
        return view('user.create',compact('roles'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'email'=>'required|min:3',
            'is_active'=>'required',
            'role_id'=>'required'
        ]);

        if(!User::whereEmail($request->email)->first()){

            if($employee = Employee::where('emp_email','=',$request->email)->first()){

                $user = new User;
                $user->email = $request->email;
                $user->password = str_random(10);
                $user->role_id = $request->role_id;
                $user->is_active = $request->is_active;
                $user->save();

                return redirect()->back()->with(['success'=>'User account created successfully!. User name and profile photo will be updated when user logged in first time.']);

            }else{
                return redirect()->back()->withErrors(['error'=>'Email does not belongs to any employee at UCSC. Please check the email again.']);
            }

        }else{
            return redirect()->back()->withErrors(['error'=>'Email Already exists']);
        }

    }

    public function edit($id){

        $user = User::whereId($id)->first();
        $roles = Role::all()->pluck('name','id');
        return view('user.edit',compact('user','roles'));


    }

    public function update(Request $request){

        $user = User::whereId($request->id)->first();
        $user->role_id = $request->role_id;
        $user->is_active = $request->is_active;
        $user->update();

        return redirect()->back()->with(['success'=>'User account has been updated successfully!.']);


    }

    public function login($type){

        Auth::login(User::whereEmail($type)->first());
        return redirect('home');

    }
}
