<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ErrorAdNotification;

class ErrorAdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $ad;
    public $mod;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $ad, $mod)
    {
        $this->user = $user;
        $this->ad = $ad;
        $this->mod = $mod;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user, new ErrorAdNotification($this->user, $this->ad, $this->mod));
    }
}
