<?php

namespace AppBuilder\Factories;

use AppBuilder\Models\Commands;


/**
 * Responsible for creating AppBuilder instance
 *
 * @author Sirenko Vlad
 */
class CommandFactory {

	const COMMAND_GENERATE = 'generate';
	const COMMAND_ROLLBACK = 'rollback';

	public static function getCommand($command)
	{
		switch ($command) {
			case self::COMMAND_GENERATE:
				return new Commands\Generate();

			case self::COMMAND_ROLLBACK:
				return new Commands\Rollback();
		}

		throw new \Exception('"' . $command . '" not found');
	}

}
