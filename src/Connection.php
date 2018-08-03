<?php

namespace YbrNX\MariaDB;

class Connection extends \Illuminate\Database\MySqlConnection
{

    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }
}
