<?php

namespace App\Subscribers;

use File;
use Hash;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;

/**
 * Class EnvironmentSavedListener
 *
 * @package App\Subscribers
 */
class EnvironmentSavedListener
{
    public function handle(EnvironmentSaved $event)
    {
        $request = $event->getRequest();

        // rachidlaasri/laravel-installer 4.0 does not support to save APP_TIMEZONE
        if ($request->has('app_timezone')) {
            $envContent = "\n\n" . "APP_TIMEZONE=" . $request->get('app_timezone') . "\n";
            file_put_contents(base_path('.env'), $envContent, FILE_APPEND);
        }

        // Persist user info from install form for later
        if ($request->has('user_username')) {
            File::put(storage_path('install.json'), json_encode([
                'name' => $request->get('user_name'),
                'username' => $request->get('user_username'),
                'email' => $request->get('user_email'),
                'password' => Hash::make($request->get('user_password')),
            ]));
        }
    }
}
