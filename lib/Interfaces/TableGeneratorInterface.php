<?php

namespace AppBuilder\Interfaces;

/**
 *
 * @author Sirenko Vlad
 */
interface TableGeneratorInterface {
	public function generateTable($name, $schema);
	
	public function registerTableRelations($relationsArray);
	
	public function setAllRelations();
}
