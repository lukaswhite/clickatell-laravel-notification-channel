<?php


namespace Lukaswhite\ClickatellLaravelNotificationChannel;

use Clickatell\Rest;
use Clickatell\ClickatellException;
use Lukaswhite\ClickatellLaravelNotificationChannel\Exceptions\ClickatellMessageFailed;

/**
 * Class ClickatellClient
 * @package Lukaswhite\ClickatellLaravelNotificationChannel
 */
class ClickatellClient
{
    /**
     * @var string string
     */
    protected string $token;

    /**
     * @var Rest
     */
    protected Rest $http;

    /**
     * ClickatellClient constructor.
     * @param Rest $http
     */
    public function __construct(Rest $http)
    {
        $this->http = $http;
    }

    /**
     * @param $to
     * @param ClickatellMessage $message
     * @throws ClickatellMessageFailed
     */
    public function send($to, ClickatellMessage $message)
    {
        try {
            $result = $this->http->sendMessage(
                [
                    'to' => is_string($to) ? [$to] : $to,
                    'content' => $message->getContent(),
                ]
            );
            //dd($result);

            /**
            array:6 [
            "apiMessageId" => "da1f459f0c00477791b817aa2b30fc9f"
            "accepted" => true
            "to" => "44xxx"
            "errorCode" => null
            "error" => null
            "errorDescription" => null
            ]
             */

        } catch (ClickatellException $e) {
            // Any API call error will be thrown and should be handled appropriately.
            // The API does not return error codes, so it's best to rely on error descriptions.
            //var_dump($e->getMessage());
            throw new ClickatellMessageFailed($e->getMessage());
        }
    }

}
