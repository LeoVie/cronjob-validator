<?php

namespace LeoVie\CronjobValidator\Exception;

use Exception;

class InvalidCronjobException extends Exception
{
    public function __construct(string $cronjob, string $reason)
    {
        $message = "Cronjob '$cronjob' is invalid: $reason.";
        parent::__construct($message);
    }
}