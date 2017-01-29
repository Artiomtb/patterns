<?php

namespace Validator;


use ObserverInterfaces\Observable;
use ObserverInterfaces\Observer;


/**
 * Validates email for valid
 *
 * Class EmailValidator
 * @package Validator
 */
class EmailValidator implements Validator, Observable
{

    private $observers = [];

    /**
     * @inheritdoc
     */
    public function addObserver(Observer $observer, string $type)
    {
        $this->observers[$type][] = $observer;
    }

    /**
     * @inheritdoc
     */
    public function fireEvent(string $type)
    {
        if (array_key_exists($type, $this->observers)) {
            $observers = $this->observers[$type];
            foreach ($observers as $observer) {
                $observer->notify($this, $type);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function getObservers(): array
    {
        return $this->observers;
    }

    /**
     * Validates email
     *
     * @param $email
     * @return bool true if email is valid
     */
    public function validate($email): bool
    {

        $result = preg_match(
            '/^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@' .
            '[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/',
            $email
        );

        if ($result) {
            $this->fireEvent(EmailValidatorEvents::SUCCESS_VALIDATE);
        } else {
            $this->fireEvent(EmailValidatorEvents::ERROR_VALIDATE);
        }

        return $result;
    }
}