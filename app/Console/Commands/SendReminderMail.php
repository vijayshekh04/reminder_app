<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:remindermail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with(['reminder'=>function($query){
            $current_date_time = date('Y-m-d H:i').":00";
            //$current_date_time = "2023-05-10 23:12:00";
            $query->where('status','0');
            $query->where('date_time',$current_date_time);
        }])->get();

        //return $users;
        foreach ($users as $user_row)
        {
            if (count($user_row->reminder) > 0)
            {
                foreach ($user_row->reminder as $reminder_row )
                {
                    $mail_data = array('title'=>$reminder_row->title,"body"=>$reminder_row->description);

                    Mail::to($user_row->email)->send(new ReminderMail($mail_data));
                    Reminder::where('id',$reminder_row->id)->update(array('status'=>'1'));
                }
            }
        }

        return Command::SUCCESS;
    }
}
