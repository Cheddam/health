<?php

namespace App\Console\Commands;

use App\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send {notification} {--pretend}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notification to subscribed users.';

    /**
     * The Notification model.
     *
     * @var Notification
     */
    protected $notification;

    /**
     * Create a new command instance.
     *
     * @var Notification $notification The Notification model.
     * @return mixed
     */
    public function __construct(Notification $notification)
    {
        parent::__construct();

        $this->notification = $notification;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notification = $this->notification->where('slug', $this->argument('notification'))->first();

        if (! $notification) {
            $this->error('Invalid notification provided.');
            return 1;
        }

        $users = $notification->subscribers;

        if (! count($users)) {
            $this->error('No subscribers to send to!');
            return 1;
        }

        if (method_exists($this, $notification->slug)) {
            $users = $this->{$notification->slug}($users);
        }

        if ($this->option('pretend')) {
            $this->info('Notification ' . $notification->name . ' would be sent to the following subscribers:');

            foreach ($users as $user) {
                $this->line($user->name . ' <' . $user->email . '>');
            }

            return 0;
        }

        foreach ($users as $user) {
            Mail::queue('emails.notifications.' . $notification->template, ['user' => $user], function($message) use ($user, $notification) {
                $message->to($user->email, $user->name);
                $message->subject($notification->subject);
            });
            $this->info('Queued notification for ' . $user->name . ' <' . $user->email . '>');
        }

        return 0;
    }

    public function evening($users)
    {
        return $users->reject(function($user) {
           return $user->hasCompletedAGoalToday();
        });
    }
}
