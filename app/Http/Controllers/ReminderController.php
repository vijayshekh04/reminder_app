<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login_id = Session::get('user_session')['login_id'];
       $reminders =  Reminder::where('user_id',$login_id)->get();
       //return $reminders;
        return view('reminder.index',compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reminder.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "title"=>"required",
            "description"=>"required",
            "date_time"=>"required",
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $date_time = $request->date_time;
        $convert_time = date('Y-m-d H:i',strtotime($date_time));

        $input =  $request->all();
        $insert_data['user_id'] = Session::get('user_session')['login_id'];
        $insert_data['title'] = $input['title'];
        $insert_data['description'] = $input['description'];
        $insert_data['date_time'] = $convert_time;

        Reminder::create($insert_data);

        Session::flash('response',"success");
        Session::flash('msg',"Reminder Added successfully!");
        return redirect('/reminder');


        //echo date('Y-m-d H:i', strtotime($date_time)); // yyyy-MM-dd'T'HH:mm:ss.SSSZ
        //date('c', strtotime($date_of_birth_input)); // yyyy-MM-ddTHH:mm:ss+00:00
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function show(Reminder $reminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Reminder::where('id',$id)->first();
        return view('reminder.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //return $request->all();

        $validator = Validator::make($request->all(),[
            "title"=>"required",
            "description"=>"required",
            "date_time"=>"required",
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $date_time = $request->date_time;
        $convert_time = date('Y-m-d H:i',strtotime($date_time));

        $input =  $request->all();
        $insert_data['user_id'] = Session::get('user_session')['login_id'];
        $insert_data['title'] = $input['title'];
        $insert_data['description'] = $input['description'];
        $insert_data['date_time'] = $convert_time;

        Reminder::where('id',$id)->update($insert_data);

        Session::flash('response',"success");
        Session::flash('msg',"Reminder Updated successfully!");
        return redirect('/reminder');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Reminder::where('id',$request['id'])->delete();
        return response()->json(array("status"=>"success","message"=>"Record Deleted Successfully"));
    }
}
