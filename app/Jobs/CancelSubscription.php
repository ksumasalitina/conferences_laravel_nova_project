<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Stripe\Subscription;

class CancelSubscription implements ShouldQueue
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
        foreach (User::all() as $user)
        {
            $subscription = DB::table('subscriptions')->where('user_id',$user->id)
                                ->where('stripe_status','active')->first();
            $datetime1 = new \DateTime($subscription->created_at);
            $datetime2 = new \DateTime('now');
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');

            if($days>=28) {
                $user->subscription($user->plan_id)->cancelNow();
                $user->newSubscription(1, 'price_1MOjmPEnpsfQaHkImwfrBRKv')->create();
                User::query()->where($user->id)->update(['plan_id'=>1, 'monthly_joins'=>0]);
            }
        }
    }
}
