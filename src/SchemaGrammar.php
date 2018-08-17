<?php

namespace YbrNX\MariaDB;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;

class SchemaGrammar extends MySqlGrammar 
{

    public function __construct()
    {
        if (!in_array('Check', $this->modifiers)) {
            array_splice(
                $this->modifiers,
                array_search('After', $this->modifiers),
                count($this->modifiers),
                array_merge(['Check'], array_slice($this->modifiers, array_search('After', $this->modifiers)))
            );
        }
    }

    protected function modifyCheck(Blueprint $blueprint, Fluent $column)
    {
        if ($this->getType($column) == 'json') {
            return sprintf(' CHECK (%sJSON_VALID(%s))', 
                $column->nullable ? ($this->wrap($column->name) . ' IS NULL OR ') : '',
                $this->wrap($column->name)
            );
        }
    }
}