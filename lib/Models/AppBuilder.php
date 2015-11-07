<?php

namespace AppBuilder\Models;

use AppBuilder\Models\TableGenerator;
use yii\gii\Generator as GiiGenerator;
use yii\base\Object;

/**
 * Responsible for creating modules
 * @author Sirenko Vlad
 */
class AppBuilder extends Object {

	private $params;
	private $_tableGenerator;
	private $_moduleGenerator;
	private $_crudGenerator;
	private $_modelGenerator;

	public function setConfiguration($configurationArray)
	{
		$this->params = $configurationArray;
		return $this;
	}

	public function setTableGenerator(TableGenerator $tableGenerator)
	{
		$this->_tableGenerator = $tableGenerator;
	}

	public function getTableGenerator()
	{
		return $this->_tableGenerator;
	}

	public function setCrudGenerator(GiiGenerator $generator)
	{
		$this->_crudGenerator = $generator;
	}

	public function setModuleGenerator(GiiGenerator $generator)
	{
		$this->_moduleGenerator = $generator;
	}

	public function setModelGenerator(GiiGenerator $generator)
	{
		$this->_modelGenerator = $generator;
	}

	public function run()
	{
		print_r($this);
	}

	public static function getDependencies()
	{
		return [
			"tableGenerator" => \Yii::$container->get('TableGenerator'),
			"moduleGenerator" => \Yii::$container->get('ModuleGenerator'),
			"modelGenerator" => \Yii::$container->get('ModelGenerator'),
			"crudGenerator" => \Yii::$container->get('CrudGenerator')
		];
	}

}
