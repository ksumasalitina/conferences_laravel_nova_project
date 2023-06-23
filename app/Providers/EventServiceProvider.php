<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\DeleteLecture;
use App\Listeners\MailDeleteLecture;
use App\Events\DeleteMeeting;
use App\Listeners\MailDeleteMeeting;
use App\Events\AddComment;
use App\Listeners\MailAddComment;
use App\Events\AddLecture;
use App\Listeners\MailAddLecture;
use App\Events\JoinListener;
use App\Listeners\MailJoinListener;
use App\Events\UpdateLecture;
use App\Listeners\MailUpdateLecture;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Meeting;
use App\Observers\MeetingObserver;
use App\Models\Lecture;
use App\Observers\LectureObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        DeleteLecture::class => [
            MailDeleteLecture::class
        ],

        DeleteMeeting::class => [
            MailDeleteMeeting::class
        ],

        AddComment::class => [
            MailAddComment::class
        ],

        AddLecture::class => [
            MailAddLecture::class
        ],

        JoinListener::class => [
            MailJoinListener::class
        ],

        UpdateLecture::class => [
            MailUpdateLecture::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(new UserObserver());
        Meeting::observe(new MeetingObserver());
        Lecture::observe(new LectureObserver());
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
