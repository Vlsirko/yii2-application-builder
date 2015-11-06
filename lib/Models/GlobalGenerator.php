<?php

namespace AppBuilder\Models;
use AppBuilder\Models\TableGenerator;

/**
 * Responsible for creating modules
 * @author Sirenko Vlad
 */
class GlobalGenerator {
	
	private $params;
	
	private $tableGeneratorInstance;
	
	private $moduleGeneratorInstance;
	
	private $crudGeneratorInstance;
	
	//private $moduleGeneratorInstance;
	
	public function setConfiguration($configurationArray){
		$this->params = $configurationArray;
	}
	
	public function setTableGeneratorInstance(TableGenerator $tableGenerator){
		$this->tableGeneratorInstance = $tableGenerator;
	}
	
	public function setCrudGeneratorInstance(TableGenerator $crudGenerator){
		$this->crudGeneratorInstance = $tableGenerator;
	}
	
	public static function registerDependencies(){
		$generators = ConfigLoader::getInstance()->getGeneratorsConfig();
		\Yii::$container->set(self::class, [
			'CrudGeneratorInstance' => new $generators['crud'](),
			'TableGeneratorInstance' => new TableGenerator(),
		]);
	}
}
