<?php

namespace App\Exceptions\Rcon;


class IdentifierDoNotMatch extends \RuntimeException
{
    /**
     * @param string          $requestId
     * @param int             $responseId
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($requestId, $responseId, $code = 0, \Exception $previous = null)
    {
        $message =
            "The request ID and response identifier do not match.
            Request ID: {$requestId}, response ID: {$responseId}";

        parent::__construct($message, $code, $previous);
    }
}
