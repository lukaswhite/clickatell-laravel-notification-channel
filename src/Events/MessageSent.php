<?php


namespace Lukaswhite\ClickatellLaravelNotificationChannel\Events;

/**
 * Class MessageSent
 *
 * Could be used to track credits used, etc.
 *
 * @package Lukaswhite\ClickatellLaravelNotificationChannel\Events
 */
class MessageSent
{
    /**
     * @var string|array
     */
    protected $to;

    /**
     * MessageSent constructor.
     * @param string|array $to
     */
    public function __construct($to)
    {
        $this->to = $to;
    }

    /**
     * @return string|array
     */
    public function getTo()
    {
        return $this->to;
    }

}
