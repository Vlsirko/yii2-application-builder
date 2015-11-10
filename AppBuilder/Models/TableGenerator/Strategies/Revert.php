<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
}
