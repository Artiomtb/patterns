<?php

use Exceptions\IncorrectAdapterNameException;
use Exceptions\ParametersParseException;
use Logger\Logger;
use Validator\EmailValidator;
use Validator\EmailValidatorEvents;

require_once "Autoloader.php";

// Example of usage addNamespacePath:
// Autoloader::addNamespacePath('MindK', 'vendor/mindk/src');


//Observer example.
//Create logger (observer) and validator (observable). Let validator fire event (success or error) based on its result.
//Pass logger as obse   rver to observable validator.
$logger = new Logger();

$emailValidator = new EmailValidator();

$emailValidator->addObserver($logger, EmailValidatorEvents::ERROR_VALIDATE);
$emailValidator->addObserver($logger, EmailValidatorEvents::SUCCESS_VALIDATE);

$emailValidator->validate("email@gmail.com");

try {
    $config = ConfigSingleton::getInstance();
    $database_factory = new DatabaseAdapterFactory();
    $adapter = $database_factory->getAdapter($config->get("database")["adapter"]);
    debug($adapter);
} catch (ParametersParseException $e) {
    echo $e->getMessage();
} catch (IncorrectAdapterNameException $e) {
    echo $e->getMessage();
}


function debug($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}