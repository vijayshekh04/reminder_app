<?php

namespace App\Http\Controllers;

use App\Mail\ReminderMail;
use App\Models\Reminder;
use App\Models\User;
use Egulias\EmailValidator\Result\SpoofEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public  function index()
    {

        if (Session::has('user_session'))
        {
            return redirect('/reminder');
        }
        return view('login');
    }


    public function login_process(Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(),[
            'email'=>"required|email",
            'password'=>"required",
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $input = $request->input();
        $user_data =  User::where('email',$input['email'])->first();

        if (!empty($user_data)){
            $encrypt_password =  $user_data->password;
            $db_password = Crypt::decrypt($encrypt_password);
            if ($db_password==$input['password']){
                $login_data_array = array(
                    "name"=>$user_data->name,
                    "login_id"=>$user_data->id,
                );

                Session::put('user_session',$login_data_array);
                Session::flash('response',"success");
                Session::flash('msg',"Login Successfully!");
                return redirect("/reminder");
            }
            else
            {
                Session::flash('login_error',"The email or password is invalid !!");
                //return redirect("/");
                return back()->withInput();
            }
        }
        else{
            Session::flash('login_error',"The email or password is invalid !!");
            return redirect("/");
        }
    }

    public function register()
    {
        if (Session::has('user_session'))
        {
            return redirect('/reminder');
        }
        return view('register');
    }

    public function register_process(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>"required",
            'email'=>"required|email|unique:users|email",
            'password'=>"required",
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input = $request->input();

        $insert_data['name'] = $input['name'];
        $insert_data['email'] = $input['email'];
        $insert_data['password'] = Crypt::encrypt($input['password']);
        User::create($insert_data);

        Session::flash('status',"success");
        Session::flash('login_message',"User Register Successfully!");
        return redirect("/");
    }

    public function logout()
    {
        Session::forget('user_session');
        return redirect()->secure(url('/'));
    }

}
