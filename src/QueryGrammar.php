<?php

namespace YbrNX\MariaDB;

use Illuminate\Database\Query\Grammars\MySqlGrammar;

class QueryGrammar extends MySqlGrammar 
{

    protected function wrapJsonSelector($value)
    {
        $path = explode('->', $value);

        $field = $this->wrapValue(array_shift($path));

        return sprintf('JSON_EXTRACT(%s, \'$.%s\')', $field, collect($path)->map(function ($part) {
            return '"'.$part.'"';
        })->implode('.'));
    }

    //make table.field->json selects work
    public function wrap($value, $prefixAlias = false)
    {
        $mysqlWrap = parent::wrap($value, $prefixAlias);

        if(Str::contains($mysqlWrap, '.JSON_EXTRACT')) {

            $path = explode('->', $value);

            $field = collect(explode('.', array_shift($path)))->map(function ($part) {
                return $this->wrapValue($part);
            })->implode('.');

            return sprintf('JSON_EXTRACT(%s, \'$.%s\')', $field, collect($path)->map(function ($part) {
                    return '"'.$part.'"';
                })->implode('.')
            );
        }

        return $mysqlWrap;
    }
}