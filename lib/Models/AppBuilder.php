<?php

namespace AppBuilder\Models;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorFactory;
use yii\base\Object;

/**
 * Responsible for creating modules
 * @author Sirenko Vlad
 */
class AppBuilder extends Object {

	private $modulesConfiguration;

	public function run()
	{
		$this->modulesConfiguration = ConfigLoader::getInstance()->getModuleConfiguration();
		$this->creatingTables()->creatingInstances();
	}

	protected function creatingTables()
	{
		GeneratorFactory::getGeneratorsFactory(GeneratorFactory::TABLE_GENERATOR_FACTORY)
			->getGenerator($this->modulesConfiguration)
			->generate();
		return $this;
	}

	protected function creatingInstances()
	{
		foreach ($this->modulesConfiguration as $module) {
			$toGenerate = ConfigLoader::getInstance()->getEntitiesToGenerate($module);
			foreach ($toGenerate as $entity) {
				$this->generate($entity, $module);
			}
		}
		return $this;
	}

	protected function generate($type, $modelParamsArray)
	{
		$generator = GeneratorFactory::getGeneratorsFactory($type)->getGenerator($modelParamsArray[$type]);
		$this->saveFiles($generator->generate());
		$generator->trigger('AFTER_CREATE');
	}
	
	protected function saveFiles($files){
		foreach($files as $file){
			$file->save();
		}
	}

}
