<?php

namespace ObserverInterfaces;

/**
 * Interfaces Observer
 */
interface Observer
{
    /**
     * Called for notify about event
     *
     * @param Observable $source
     * @param string $type
     */
    public function notify(Observable $source, string $type);
}