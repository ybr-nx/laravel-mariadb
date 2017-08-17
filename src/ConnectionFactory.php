<?php

namespace YbrNX\MariaDB;

use Illuminate\Database\Connectors\MySqlConnector;

class ConnectionFactory extends \Illuminate\Database\Connectors\ConnectionFactory
{
    public function createConnector(array $config)
    {
        return new MySqlConnector;
    }

    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = [])
    {
        return new Connection($connection, $database, $prefix, $config);
    }
}