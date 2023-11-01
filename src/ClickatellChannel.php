<?php


namespace Lukaswhite\ClickatellLaravelNotificationChannel;

use Illuminate\Notifications\Notification;
use Lukaswhite\ClickatellLaravelNotificationChannel\Events\MessageSent;
use Lukaswhite\ClickatellLaravelNotificationChannel\Exceptions\ClickatellMessageFailed;
use Lukaswhite\ClickatellLaravelNotificationChannel\Exceptions\InvalidRecipients;

class ClickatellChannel
{
    /**
     * @var ClickatellClient
     */
    protected $client;

    /**
     * ClickatellChannel constructor.
     * @param ClickatellClient $client
     */
    public function __construct(ClickatellClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @throws InvalidRecipients
     * @throws ClickatellMessageFailed
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('clickatell')) {
            return;
        }

        if(!is_string($to) && !is_array($to)){
            throw new InvalidRecipients('The recipient must be a string, or array of strings');
        }

        $message = $notification->toClickatell($notifiable);

        if (is_string($message)) {
            $message = new ClickatellMessage($message);
        }

        $this->client->send($to, $message);

        event(new MessageSent($to));
    }
}
