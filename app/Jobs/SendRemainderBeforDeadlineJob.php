<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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

        // $updatedRequest = DB::table('requests')
        // ->where('user_id', $user_id)
        // ->where('slide_id', $slide_id)
        // ->first();

        // if ($updatedRequest->request_state === 'approved') {
        //     $endDate = $updatedRequest->end_date;
        //     if (Carbon::now()->greaterThan($endDate)) {
        //         DB::table('users')
        //         ->where('id', $user_id)
        //             ->update(['blocked' => true]);
        //     }
        // }



    }
}
