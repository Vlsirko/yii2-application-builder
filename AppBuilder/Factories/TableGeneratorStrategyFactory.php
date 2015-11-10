<?php

namespace AppBuilder\Factories;

use AppBuilder\Models\TableGenerator\Strategies;
/**
 * Description of TableGeneratorCommandFactory
 *
 * @author vlad
 */
class TableGeneratorStrategyFactory {

	const COMMAND_ROLLBACK = 'rollback';
	const COMMAND_GENERATE = 'generate';

	private $command;

	public function __construct($commandName)
	{
		$this->command = $this->getCommandByName($commandName);
	}
	
	public function getCommand(){
		return $this->command;
	}

	private function getCommandByName($name)
	{

		switch ($name) {
			case self::COMMAND_ROLLBACK:
				return new Strategies\Revert();
			case self::COMMAND_GENERATE:
				return new Strategies\Generate();
		}

		throw new \Exception("{$name} strategy not found in " . get_class($this));
	}

}
