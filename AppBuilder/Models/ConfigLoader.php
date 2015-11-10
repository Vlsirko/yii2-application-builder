<?php

namespace AppBuilder\Models;

use yii\helpers\Json;
use AppBuilder\Factories\Generators\AbstractFactory;

/**
 * Description of configLoader
 *
 * @author Sirenko Vlad
 */
class ConfigLoader {

	private static $instance = null;
	private $pathToModuleConfig = null;
	private $config = null;
	private $configLoaded = false;
	private $pathToDependencieUserFile = null;
	private $mainDependenciesConfig = null;

	private function __construct()
	{
		$this->pathToModuleConfig = \Yii::getAlias('@app') . '/config/app_structure.json';
		$this->pathToDependencieUserFile = \Yii::getAlias('@app') . '/config/app_dependencies.json';
		$this->registerDependencies();
	}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function getModuleConfiguration()
	{
		if (!$this->configLoaded) {
			$this->loadConfig();
		}
		return $this->config;
	}

	private function loadConfig()
	{
		if (!$this->configFileExists()) {
			throw new \Exception("Config file is missed!");
		}
		$json = file_get_contents($this->pathToModuleConfig);


		$this->config = $this->configValidation(Json::decode($json, true));
		$this->configLoaded = true;
	}

	private function configFileExists()
	{
		return file_exists($this->pathToModuleConfig);
	}

	private function configValidation($configArray)
	{
		/**
		 * TODO: add structure validation
		 */
		return $configArray;
	}

	private function getDependenciesConfiguration()
	{
		$config = $this->getMainDependenciesConfig();

		if ($this->userDependenciesFileExists()) {
			$userFileConfig = $this->getUserDependenciesConfig();
			$config = array_replace_recursive($config, $userFileConfig);
		}

		return $config;
	}

	private function getMainDependenciesConfig()
	{
		if (is_null($this->mainDependenciesConfig)) {
			$this->mainDependenciesConfig = require \yii::getAlias("@appBuilder") . "/config/Dependencies.php";
		}
		return $this->mainDependenciesConfig;
	}

	private function getUserDependenciesConfig()
	{
		$config = [];
		if ($this->userDependenciesFileExists()) {
			$userConfig = file_get_contents($this->pathToDependencieUserFile);
			$config = \yii\helpers\Json::decode($userConfig);
		}
		return $config;
	}

	private function userDependenciesFileExists()
	{
		return file_exists($this->pathToDependencieUserFile);
	}

	public function registerDependencies()
	{
		$dependencies = $this->getDependenciesConfiguration();
		foreach ($dependencies as $className => $refs) {
			\Yii::$container->set($className, $refs);
		}
	}
	
	public function getAvaliableEntitiesFromConfig($module){
		
		$allowedEntities = [
			AbstractFactory::MODEL_GENERATOR_FACTORY, 
			AbstractFactory::CRUD_GENERATOR_FACTORY, 
			AbstractFactory::MODULE_GENERATOR_FACTORY
		];
		
		return array_intersect($allowedEntities, array_keys($module));
	}

}
