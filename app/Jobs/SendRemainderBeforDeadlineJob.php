<?php

namespace App\Jobs;

use App\Http\Controllers\RequestController;
use App\Mail\AccountBlocked;
use App\Mail\DeadlineApproaching;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendRemainderBeforDeadlineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //User::factory()->create();

        // Update blocked column in users table if end date has passed

        // Create an instance of RequestController
        $requestController = new RequestController();

        $request  = DB::table('requests')
        ->get();
        if ($request->request_state === 'approved') {
            if ($request && is_null($request->start_date) && Carbon::parse($request->start_date)->subDays(4)->isPast()) {  // added condition to check for start_date before 3 days
                $requestController->destroy($request->user_id, $request->slide_id); // Call the destroy method on the instance
                return response()->json(['message' => 'Request archived successfully.']);
            }
            elseif($request && !is_null($request->start_date)&& !$request->returned_state ){  // telling the user that he blocked ! 
                if( Carbon::now()->greaterThan($request->endDate)){
                    DB::table('users')
                        ->where('id', $request->user_id)
                        ->update(['blocked' => true]);

                $user = User::findOrFail($request->user_id);
                Mail::to($request->user->email)->send(new AccountBlocked($request->user_id, $request->slide_id,$request->end_date));

                }
                elseif(Carbon::parse($request->endDate)->diffInDays() == 2){   // remember the user before the deadline 
                    DB::table('users')
                        ->where('id', $request->user_id)
                        ->update(['blocked' => true]);

                $user = User::findOrFail($request->user_id);
                Mail::to($user->email)->send(new DeadlineApproaching($request->user_id, $request->slide_id,$request->end_date));
                }

            }
            else {
                return response()->json(['error' => 'Request not found or conditions not met.'], 404);
            }
            
            






            // elseif($request && !is_null($request->start_date)&& !$request->returned_state && Carbon::now()->greaterThan($request->endDate)){
            //     DB::table('users')
            //         ->where('id', $request->user_id)
            //         ->update(['blocked' => true]);

            //     $user = User::findOrFail($request->user_id);
            //     Mail::to($request->user->email)->send(new AccountBlocked($request->user_id, $request->slide_id,$request->end_date));



                

            // }
            // elseif($request && !is_null($request->start_date)&& !$request->returned_state &&Carbon::parse($request->endDate)->diffInDays() == 2){
            //     DB::table('users')
            //     ->where('id', $request->user_id)
            //     ->update(['blocked' => true]);

            //     $user = User::findOrFail($request->user_id);
            //     Mail::to($user->email)->send(new DeadlineApproaching($request->user_id, $request->slide_id,$request->end_date));
            // }
           
        }



    // if ($request ->request_state === 'approved') {
    //     $endDate = $request ->end_date;
    //     $startDate = $request ->start_date;


    // if ($startDate==='null') {
    //         DB::table('users')
    //         ->where('id', $user_id)
    //             ->update(['blocked' => true]);
    //     }


    //     if (Carbon::now()->greaterThan($endDate)) {
    //         DB::table('users')
    //         ->where('id', $user_id)
    //             ->update(['blocked' => true]);
    //     }
    // }


    // $requests = DB::table('requests')
    //     ->where('request_state', 'approved')
    //     ->whereDate('end_date', Carbon::now()->addDays(2)->toDateString())
    //     ->get();

    // foreach ($requests as $request) {
    //     $user = User::find($request->user_id);
    // // Send email to $user here


    // public function build()
    // {
    //     return $this->subject('Reminder: Slide Request Deadline Approaching')
    //     ->view('emails.deadline-reminder')
    //     ->with([
    //         'userName' => $this->userName,
    //         'slideName' => $this->slideName,
    //         'endDate' => $this->endDate,
    //     ]);
    // }
    //php artisan make:mail AccountBlocked --markdown=emails.Account-Blocked

}

}
