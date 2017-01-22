<?php


namespace Validator;


interface Validator
{
    /**
     * Validates object for rules
     *
     * @param $object
     * @return bool result
     */
    public function validate($object): bool;
}