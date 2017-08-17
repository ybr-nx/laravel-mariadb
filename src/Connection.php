<?php

namespace YbrNX\MariaDB;

class Connection extends \Illuminate\Database\MySqlConnection
{
    protected function getDefaultQueryGrammar()
    {
        return new QueryGrammar;
    }
}
