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

        if($employee = Employee::where('emp_email','=',$gEmail)->first()){

            if($employee->emp_state === 'active'){

                if($user = User::where('emp_id','=',$employee->r_id)->first()){
                    $user->avatar = $gUser->avatar;
                    $user->name = $gUser->name;
                    $user->update();
                    Auth::login($user,true);
                    return redirect('/home');
                }else{
                    $user = new User;
                    $user->emp_id = $employee->r_id;
                    $user->name = $gUser->name;
                    $user->email = $gEmail;
                    $user->avatar = $gUser->avatar;
                    $user->token = $gUser->token;
                    $user->password = str_random(10);
                    $user->role_id = 5;
                    $user->save();

                    Auth::login($user,true);
                    return redirect('/home');
                }

            }elseif ($employee->emp_state === 'inactive'){

                return redirect('/login')->withErrors(['Access denied. Your account has been deactivated. Please contact admin.']);

            };

        }else{

            return redirect('/login')->withErrors(['Access denied. Your gmail account doesn\'t match with our records. Please request a user account from admin.']);

        }
//        if($user = User::whereEmail($gEmail)->first()){
//
//            if($user->is_active==1){
//
//                $user->name = $gUser->name;
//                $user->avatar = $gUser->avatar;
//                $user->token = $gUser->token;
//                if($gUser->refreshToken){
//                    $user->refresh_token = $gUser->refreshToken;
//                }
//                if($gUser->refreshToken){
//                    $user->refresh_token = $gUser->refreshToken;
//                }
//
//                if($code =  $request->code){
//                    $user->access_token = $access_token['access_token'];
//                }
//
//                $user->update();
//
//
//                Auth::login($user,true);
//                return redirect('home');
//
//            }else{
//                return redirect('/login')->withErrors(['Your account has been disabled. Please contact Admin.']);
//            }
//        }else{
//            return redirect('/login')->withErrors(['Access denied. Your email account doesn\'t match with our records. Please request a user account from admin.']);
//        }

    }

    public function index(){
        if(Auth::user()->canViewUser()){

            $users = Employee::where('emp_email','!=','')->get();
            return view('user.index',compact('users'));

        }
        return redirect('home');
    }

    public function edit($id){

        if(Auth::user()->canUpdateUser()){

            if ($employee = Employee::where('r_id','=',$id)->first()){

                if ($user = User::where('emp_id','=',$employee->r_id)->first()){

                }else{
                    $user = new User;
                    $user->emp_id = $employee->r_id;
                    $user->role_id = 5;
                    $user->name = $employee->emp_firstname.' '.$employee->emp_surname;
                    $user->email = $employee->emp_email;
                    $user->password = str_random(10);
                }

                $roles = Role::all()->pluck('name','id');
                return view('user.edit',compact('user','roles'));
            }

        }
        return redirect('home');


    }

    public function update(Request $request){

        if(Auth::user()->canUpdateUser()){

            $this->validate($request,[
                'emp_id'=>'required',
                'role_id'=>'required'
            ]);

            if ($employee = Employee::where('r_id','=',$request->emp_id)->first()){

                if ($user = User::where('emp_id','=',$employee->emp_id)->first()){
                    $user->emp_id = $employee->r_id;
                    $user->role_id = $request->role_id;
                    $user->email = $employee->emp_email;
                    $user->name = $employee->emp_firstname.' '.$employee->emp_surname;
                    $user->password = str_random(10);
                    $user->update();
                }else{
                    $user = new User;
                    $user->emp_id = $employee->r_id;
                    $user->role_id = $request->role_id;
                    $user->email = $employee->emp_email;
                    $user->name = $employee->emp_firstname.' '.$employee->emp_surname;
                    $user->password = str_random(10);
                    $user->save();
                }

                return redirect()->back()->with(['success'=>'User account has been updated successfully!.']);

            }

        }
        return redirect('home');
    }

    public function tokenLogin($email, $token){
        if ($token = Token::where('emp_email','=',$email)
            ->where('token','=',$token)->first()) {
            if($employee = Employee::where('emp_email','=',$email)->first()){
                if($employee->emp_state === 'active'){
                    if($user = User::where('emp_id','=',$employee->r_id)->first()){
                        $user->name = $employee->shortName;
                        $user->update();
                        Auth::login($user,true);
                        return redirect('/home');
                    }else{
                        $user = new User;
                        $user->emp_id = $employee->r_id;
                        $user->name = $employee->shortName;
                        $user->email = $employee->emp_email;
                        $user->password = str_random(10);
                        $user->role_id = 5;
                        $user->save();
                        Auth::login($user,true);
                        return redirect('/home');
                    }
                }elseif ($employee->emp_state === 'inactive'){
                    return redirect('/login')->withErrors(['Access denied. Your account has been deactivated. Please contact admin.']);
                };
            }else{
                return redirect('/login')->withErrors(['Access denied. Your gmail account doesn\'t match with our records. Please request a user account from admin.']);
            }
           }
        return redirect('/login')->withErrors(['Access denied. Your gmail account doesn\'t match with our records. Please request a user account from admin.']);
    }

    public function login($type){

        Auth::login(User::whereEmail($type)->first());
        return redirect('home');

    }
}
