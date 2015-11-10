<?php

namespace AppBuilder\Models\TableGenerator;

use AppBuilder\Factories\ExceptionHandlers\ExceptionHandlerFactory;
use AppBuilder\Models\Messager;
use AppBuilder\Models\TableGenerator\Strategies\TableGeneratorStrategyInterface;

/**
 * Create table from configuration file
 * @author Sirenko Vlad
 */
class TableGenerator {

	protected $tablesCommandStorage = [];
	protected $relationCommandStorage = [];
	protected $configuration;
	protected $connection;
	protected $commandStrategy;

	public function __construct(TableGeneratorStrategyInterface $strategy)
	{
		$this->connection = \Yii::$app->db;
		$this->commandStrategy = $strategy;
	}
	
	public function parseConfiguration($configuration)
	{
		$this->configuration = $configuration;
		foreach ($this->configuration as $module) {
			$this->registerTable($module['table']);
			$this->registerTableRelations($module['table']);
		}
	}
	
	protected function registerTable($tableConfiguration)
	{
		$this->tablesCommandStorage[$tableConfiguration['table_name']] = $this->commandStrategy->getRegisterTableCommand($tableConfiguration);
	}
	
	protected function registerTableRelations($tableConfiguration)
	{
		if(!isset($tableConfiguration['relations'])){
			return false;
		}
		
		$tableName = $tableConfiguration['table_name'];
		$relations = $tableConfiguration['relations'];
		$commands = $this->commandStrategy->getRegisterRelationsCommand($tableName, $relations);
		$this->relationCommandStorage =  $commands;
	}
	
	
	public function generate()
	{
		$transaction = $this->connection->beginTransaction();
		try {
			$this->runTablesCommands();
			$this->runRelationsCommands();
		} catch (\yii\db\Exception $e) {
			$transaction->rollBack();
			throw new \Exception($e->getMessage());
		}
	}
	
	protected function runTablesCommands()
	{
		foreach ($this->tablesCommandStorage as $moduleName => $command) {
			try {
				Messager::getInstance()->showMessage('Generating "' . $moduleName . "' table");
				$command->execute();
			} catch (\Exception $e) {
				ExceptionHandlerFactory::getHandlerViaException($e)->handle();
			}
		}
	}
	
	protected function runRelationsCommands()
	{
		foreach ($this->relationCommandStorage as $moduleName => $command) {
			try {
				Messager::getInstance()->showMessage('Generating relation "' . $moduleName . "'");
				$command->execute();
			} catch (\Exception $e) {
				ExceptionHandlerFactory::getHandlerViaException($e)->handle();
			}
		}
	}
	
	

	public function getName()
	{
		return "TableGenerator";
	}
	
	
	protected function validateSchema($schema)
	{
		/**
		 * TODO:	 SCHEMA VALIDATION
		 */
		return $schema;
	}
	
}
