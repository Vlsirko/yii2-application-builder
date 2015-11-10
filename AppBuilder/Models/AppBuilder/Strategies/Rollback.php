<?php

namespace AppBuilder\Models\AppBuilder\Strategies;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorFactory;
use AppBuilder\Factories\TableGeneratorStrategyFactory;
use AppBuilder\Factories\TableGeneratorFactory;
use AppBuilder\Models\ConfigLoader;
use AppBuilder\Models\Messager;
use yii\gii\CodeFile;
use yii\base\ErrorException;

/**
 * Description of Rollback
 *
 * @author Sirenko Vlad
 */
class Rollback extends AbstractAppBuilderStrategy {

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

	public function process()
	{
		$this->processingModules()->processingTables();
	}

}
