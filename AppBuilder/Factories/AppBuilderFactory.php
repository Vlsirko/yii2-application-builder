<?php

namespace AppBuilder\Factories;

use AppBuilder\Models\AppBuilder\Strategies;
use AppBuilder\Models\AppBuilder\AppBuilder;

/**
 * Responsible for creating AppBuilder instance
 *
 * @author Sirenko Vlad
 */
class AppBuilderFactory {

	const COMMAND_GENERATE = 'generate';
	const COMMAND_ROLLBACK = 'rollback';

	public static function getAppBuilderByCommand($command)
	{
		$strategy = self::getAppBuilderStrategyByCommand($command);
		return new AppBuilder($strategy);
	}

	protected static function getAppBuilderStrategyByCommand($command)
	{
		switch ($command) {
			case self::COMMAND_GENERATE:
				return new Strategies\Generate();

			case self::COMMAND_ROLLBACK:
				return new Strategies\Rollback();
		}

		throw new \Exception('"' . $command . '" not found');
	}

}
