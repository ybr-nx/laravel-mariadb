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
    		$this->modifiers[] = 'Check';
    	}
    }

    protected function modifyCheck(Blueprint $blueprint, Fluent $column)
    {
        if (in_array($this->getType($column), ['json', 'jsonb'])) {
        	return sprintf(' CHECK (%sJSON_VALID(%s))', 
        		$column->nullable ? ($this->wrap($column->name) . ' IS NULL OR ') : '',
        		$this->wrap($column->name)
        	);
        }
    }
}