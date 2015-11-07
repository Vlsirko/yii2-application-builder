<?php

namespace AppBuilder\Models;
use AppBuilder\Models\TableGenerator;
use yii\gii\generators\model\Generator as ModelGenerator;
use yii\gii\generators\crud\Generator as CrudGenerator;
use yii\gii\generators\module\Generator as ModuleGenerator;

/**
 * Responsible for creating modules
 * @author Sirenko Vlad
 */
class AppBuilder {
	
	private $params;
	
	private $tableGenerator;
	
	private $moduleGenerator;
	
	private $crudGenerator;
	
	private $modelGenerator;
	
	
	public function __construct(TableGenerator $tableGenerator, 
								ModelGenerator $modelGenerator,
								CrudGenerator $crudGenerator,
								ModuleGenerator $moduleGenerator)
	{
		$this->tableGenerator = $tableGenerator;
		$this->modelGenerator = $modelGenerator;
		$this->crudGenerator = $crudGenerator;
		$this->moduleGenerator = $moduleGenerator;
	}
	public function setConfiguration($configurationArray){
		$this->params = $configurationArray;
		return $this;
	}
	
	public function run(){
		print_r($this);
	}
}
