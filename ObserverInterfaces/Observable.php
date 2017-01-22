<?php

namespace ObserverInterfaces;

/**
 * Interfaces Observable
 */
interface Observable
{
    /**
     * Adds Observer to current Observable object
     *
     * @param Observer $observer
     * @param string $type
     */
    public function addObserver(Observer $observer, string $type);

    /**
     * Fires event for current type
     *
     * @param string $type
     * @return mixed
     */
    public function fireEvent(string $type);

    /**
     * Returns observers array
     *
     * @return mixed
     */
    public function getObservers(): array;
}
