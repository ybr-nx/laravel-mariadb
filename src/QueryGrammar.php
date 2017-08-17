<?php

namespace YbrNX\MariaDB;

use Illuminate\Database\Query\Grammars\MySqlGrammar;

class QueryGrammar extends MySqlGrammar 
{

    protected function wrapJsonSelector($value)
    {
        $path = explode('->', $value);

        $field = $this->wrapValue(array_shift($path));

        return sprintf('JSON_VALUE(%s, \'$.%s\')', $field, collect($path)->map(function ($part) {
            return '"'.$part.'"';
        })->implode('.'));
    }

}