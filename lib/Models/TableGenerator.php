<?php

namespace AppBuilder\Models;

use yii\gii\generators\model\Generator;

/**
 * Create table from configuration file
 * @author Sirenko Vlad
 */
class TableGenerator extends Generator{

	protected $tablesCommandStorage = [];
	protected $relationCommandStorage = [];
	protected $configuration;
	protected $connection;

	public function __construct()
	{
		$this->connection = \Yii::$app->db;
	}
	
	public function getName()
	{
		return "TableGenerator";
	}

	public function parseConfiguration($configuration)
	{
		$this->configuration = $configuration;
		foreach ($this->configuration as $module) {
			$options = isset($module['table']['options']) ? $module['table']['options'] : null;
			$this->registerTable($module['table']['table_name'], $module['table']['schema'], $options);
			
			if(isset($module['table']['relations'])){
				$this->registerTableRelations($module['table']['table_name'], $module['table']['relations']);
			}
		}
	}

	protected function registerTable($name, $schema, $options = null)
	{
		$this->tablesCommandStorage[$name] = $this->connection->createCommand()->createTable($name, $schema, $options);
	}

	protected function registerTableRelations($name, $relationsArray)
	{
		foreach ($relationsArray as $relationName => $relation) {
			$this->relationCommandStorage[$relationName] = $this->connection->createCommand()->addForeignKey(
				$relationName, $name, $relation['column'], $relation['ref_table'], $relation['ref_column'], isset($relation['delete']) ? $relation['delete'] : null, isset($relation['update']) ? $relation['update'] : null
			);
		}
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
			Messager::getInstance()->showMessage('Generating "' . $moduleName . "'");
			$command->execute();
		}
	}
	
	protected function runRelationsCommands()
	{
		foreach ($this->relationCommandStorage as $moduleName => $command) {
			Messager::getInstance()->showMessage('Generating relation "' . $moduleName . "'");
			$command->execute();
		}
	}

	protected function validateSchema($schema)
	{
		/**
		 * TODO:	 SCHEMA VALIDATION
		 */
		return $schema;
	}

}
