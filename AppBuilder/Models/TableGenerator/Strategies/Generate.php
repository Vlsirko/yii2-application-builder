<?php

namespace AppBuilder\Models\TableGenerator\Strategies;
use \AppBuilder\Models\TableGenerator\TableGenerator;
/**
 * Description of Generate
 *
 * @author Sirenko Vlad
 */
class Generate implements TableGeneratorStrategyInterface {

	public function getRegisterTableCommand($tableConfigurationArray)
	{
		$command = \Yii::$app->db->createCommand();
		$options = isset($tableConfigurationArray['options']) ? $tableConfigurationArray['options'] : null;
		$command->createTable($tableConfigurationArray['table_name'], $tableConfigurationArray['schema'], $options);
		return $command;
	}

	public function getRegisterRelationsCommand($name, $relationsArray)
	{
		$returnArray = array();
		foreach ($relationsArray as $relationName => $relation) {
			$command = \Yii::$app->db->createCommand();
			$returnArray[$relationName] = $command->addForeignKey(
				$relationName, $name, $relation['column'], $relation['ref_table'], $relation['ref_column'], isset($relation['delete']) ? $relation['delete'] : null, isset($relation['update']) ? $relation['update'] : null
			);
		}
		
		return $returnArray;
	}
	
	public function execCommands(\AppBuilder\Models\TableGenerator\TableGenerator $generator)
	{
		$generator->runTablesCommands();
		$generator->runRelationsCommands();
	}
	
	public function getName(){
		return 'Generate';
	}
}
