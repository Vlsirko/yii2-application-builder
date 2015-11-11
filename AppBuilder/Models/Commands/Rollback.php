<?php

namespace AppBuilder\Models\Commands;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorFactory;
use AppBuilder\Factories\TableGeneratorStrategyFactory;
use AppBuilder\Factories\TableGeneratorFactory;
use AppBuilder\Models\ConfigLoader;

/**
 * Description of Rollback
 *
 * @author Sirenko Vlad
 */
class Rollback extends AbstractCommand {

	public function processingTables()
	{
		TableGeneratorFactory::getGenerator($this->modulesConfiguration, TableGeneratorStrategyFactory::COMMAND_ROLLBACK)
			->generate();
		return $this;
	}

	public function processingModules()
	{
		foreach ($this->modulesConfiguration as $module) {
			$toGenerate = ConfigLoader::getInstance()->getAvaliableEntitiesFromConfig($module);
			$toGenerateReversed = array_reverse($toGenerate);
			foreach ($toGenerateReversed as $entity) {
				$this->drop($entity, $module);
			}
		}
		return $this;
	}

	protected function drop($type, $modelParamsArray)
	{
		GeneratorFactory::getGeneratorsFactory($type)->getDestroyer($modelParamsArray[$type])->destroy();
	}

	public function execute()
	{
		$this->processingModules()->processingTables();
	}

}
