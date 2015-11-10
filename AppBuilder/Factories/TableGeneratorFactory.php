<?php

namespace AppBuilder\Factories;

use AppBuilder\Factories\TableGeneratorStrategyFactory;
use AppBuilder\Models\TableGenerator\TableGenerator;

/**
 * Description of TableGeneratorFactory
 *
 * @author vlad
 */
class TableGeneratorFactory {

	public static function getGenerator($moduleConfigurationArray, $createCommandStrategyName)
	{
		$commandStrategy = new TableGeneratorStrategyFactory($createCommandStrategyName);
		$generator = new TableGenerator($commandStrategy->getCommand());
		$generator->parseConfiguration($moduleConfigurationArray);
		return $generator;
	}

}
