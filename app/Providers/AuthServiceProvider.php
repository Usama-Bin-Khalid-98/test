<?php

namespace App\Providers;

use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $path = parse_url($url, PHP_URL_PATH); // Gets the path component of the URL
            $parts = explode('/', $path); // Splits the path into an array of parts
            $id = $parts[3];
            $user = User::find($id);
            $string = "Dear " . $user->name . ",";
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line($string)
                ->line('Please, click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });

        //
    }
}
