<?php

namespace AppBuilder\Models;
use AppBuilder\Models\TableGenerator;

/**
 * Responsible for creating modules
 * @author Sirenko Vlad
 */
class AppBuilder {
	
	private $params;
	
	private $tableGeneratorInstance;
	
	private $moduleGeneratorInstance;
	
	private $crudGeneratorInstance;
	
	//private $moduleGeneratorInstance;
	
	public function setConfiguration($configurationArray){
		$this->params = $configurationArray;
	}
	
	public function setTableGenerator(TableGenerator $tableGenerator){
		$this->tableGeneratorInstance = $tableGenerator;
	}
	
	public function setCrudGenerator(TableGenerator $crudGenerator){
		$this->crudGeneratorInstance = $crudGenerator;
	}
}
