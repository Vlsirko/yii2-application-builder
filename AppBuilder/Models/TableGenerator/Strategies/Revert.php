<?php
namespace AppBuilder\Models\TableGenerator\Strategies;

/**
 * Description of Revert
 *
 * @author Sirenko Vlad
 */
class Revert implements TableGeneratorStrategyInterface{

	public function getRegisterTableCommand($tableConfigurationArray)
	{
		$command = \Yii::$app->db->createCommand();
		$command->dropTable($tableConfigurationArray['table_name']);
		return $command;
	}

	public function getRegisterRelationsCommand($name, $relationsArray)
	{
		$returnArray = array();
		foreach ($relationsArray as $relationName => $relation) {
			$command = \Yii::$app->db->createCommand();
			$returnArray[$relationName] = $command->dropForeignKey($relationName, $name);
		}
		
		return $returnArray;
	}
	
	public function execCommands(\AppBuilder\Models\TableGenerator\TableGenerator $generator)
	{
		$generator->runRelationsCommands();
		$generator->runTablesCommands();
	}
	
	public function getName(){
		return 'Revert';
	}
}
