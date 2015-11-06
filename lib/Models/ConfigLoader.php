<?php

namespace AppBuilder\Models;

use yii\helpers\Json;

/**
 * Description of configLoader
 *
 * @author Sirenko Vlad
 */
class ConfigLoader {

	private static $instance = null;
	private $pathToConfig = null;
	private $config = null;
	private $configLoaded = false;

	private function __construct()
	{
		$this->pathToConfig = \Yii::getAlias('@app') . '/config/app_structure.json';
	}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	private function setPathToConfig($path)
	{
		$this->pathToConfig = $path;
	}

	public function getModuleConfiguration()
	{
		if (!$this->configLoaded) {
			$this->loadConfig();
		}
		return $this->config['modules'];
	}

	private function loadConfig()
	{
		if (!$this->configExists()) {
			throw new \Exception("Config file is missed!");
		}
		$json = file_get_contents($this->pathToConfig);


		$this->config = $this->configValidation(Json::decode($json, true));
		$this->configLoaded = true;
	}

	private function configExists()
	{
		return file_exists($this->pathToConfig);
	}

	private function configValidation($configArray)
	{
		/**
		 * TODO: add structure validation
		 */
		return $configArray;
	}
	
	public function getGeneratorsConfig(){
		if (!$this->configLoaded) {
			$this->loadConfig();
		}
		return $this->config['generators'];
	}
}
