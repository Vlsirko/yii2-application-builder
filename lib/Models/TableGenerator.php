<?php

namespace AppBuilder\Models;
use AppBuilder\Interfaces\TableGeneratorInterface;
/**
 * Create table from configuration file
 * @author Sirenko Vlad
 */
class TableGenerator implements TableGeneratorInterface{
	
	private $relationStorage = [];
	
	public function generateTable($name, $schema)
	{
		
	}
	
	public function registerTableRelations($relationsArray){
		
	}
	
	public function setAllRelations(){
		
	}

}
