<?php

/**
 * Implementation of DatabaseAdapterI for postres database
 *
 * Class PostgreSQLAdapter
 */
class PostgreSQLAdapter implements DatabaseAdapterI
{

    /**
     * @inheritdoc
     */
    function connect()
    {
        echo "Connected to postgres<br>";
    }

    /**
     * @inheritdoc
     */
    function disconnect()
    {
        echo "Disconnected from postgres<br>";
    }

    /**
     * @inheritdoc
     */
    function select($params)
    {
        echo "Send query to PostgresDB: ".$params."<br>";
    }
}