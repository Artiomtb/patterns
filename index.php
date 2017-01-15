<?php

require_once "ConfigSingleton.php";
require_once "DatabaseAdapterFactory.php";
require_once "DatabaseAdapters/DatabaseAdapters.php";

try {
    $config = ConfigSingleton::getInstance();
} catch (ParametersParseException $e) {
    echo $e->getMessage();
}

try {
    $database_factory = new DatabaseAdapterFactory();
    $adapter = $database_factory->getAdapter($config->get("database")["adapter"]);
    debug($adapter);
} catch (IncorrectAdapterNameException $e) {
    echo $e->getMessage();
}


function debug($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}