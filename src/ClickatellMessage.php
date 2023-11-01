<?php


namespace Lukaswhite\ClickatellLaravelNotificationChannel;


class ClickatellMessage
{
    /**
     * @var string
     */
    protected $content;

    /**
     * ClickatellMessage constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

}
