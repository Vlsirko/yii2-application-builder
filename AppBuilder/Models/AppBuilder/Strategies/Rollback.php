<?php

namespace AppBuilder\Models\AppBuilder\Strategies;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorsFactory;
use AppBuilder\Factories\TableGeneratorStrategyFactory;
use AppBuilder\Factories\TableGeneratorFactory;

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

		return $this;
	}

}
