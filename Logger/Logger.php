<?php

namespace Logger;


use ObserverInterfaces\Observable;
use ObserverInterfaces\Observer;
use Validator\EmailValidator;
use Validator\EmailValidatorEvents;

/**
 * Class for logging
 *
 * Class Logger
 * @package Logger
 */
class Logger implements Observer
{

    const INFO = "INFO ";
    const ERROR = "ERROR";
    const WARN = "WARN ";
    const DEBUG = "DEBUG";

    /**
     * Called for notify about event
     *
     * @param Observable $source
     * @param string $type
     */
    public function notify(Observable $source, string $type)
    {
        echo "Fired with type " . $type . "<br>";

        if ($source instanceof EmailValidator) {
            switch ($type) {
                case EmailValidatorEvents::ERROR_VALIDATE:
                    $this->log("Incorrect email", self::ERROR);
                    break;
                case EmailValidatorEvents::SUCCESS_VALIDATE:
                    $this->log("Correct email", self::DEBUG);
                    break;
            }
        }
    }

    public function log(string $message, string $type)
    {
        echo "<i>[" . $type . "]: " . $message . "</i>";
    }
}