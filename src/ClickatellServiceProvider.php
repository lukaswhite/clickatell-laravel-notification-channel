<?php


namespace Lukaswhite\ClickatellLaravelNotificationChannel;

use Illuminate\Support\ServiceProvider;
use Clickatell\Rest;
use Lukaswhite\ClickatellLaravelNotificationChannel\Exceptions\MissingToken;

class ClickatellServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->when(ClickatellChannel::class)
            ->needs(ClickatellClient::class)
            ->give(function () {
                $config = config('services.clickatell');

                if(!$config || !is_array($config)
                    || !array_key_exists('token', $config) || empty($config['token'])){
                    throw new MissingToken('You need to provide an access token');
                }

                return new ClickatellClient(new Rest($config['token']));
            });
    }
}
