<?php

namespace App\Providers;

use App\Models\SmptSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Schema::hasTable('smpt_settings')) {
            $smtSetting = SmptSetting::first();

            if ($smtSetting) {
                $config = array(
                    'driver' => $smtSetting->mailer,
                    'host' => $smtSetting->host,
                    'port' => $smtSetting->port,
                    'from' => [
                        'address' => $smtSetting->from_address,
                        'name' => 'LMS'
                    ],
                    'encryption' => $smtSetting->encryption,
                    'username' => $smtSetting->username,
                    'password' => $smtSetting->password,
                );
                Config::set('mail', $config);
            }
        }
    }
}
