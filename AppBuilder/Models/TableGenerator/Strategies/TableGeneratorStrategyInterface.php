<?php
namespace AppBuilder\Models\TableGenerator\Strategies;

/**
 * Description of TableGeneratorStrategyInterface
 *
 * @author Sirenko Vlad
 */
interface TableGeneratorStrategyInterface {
	
	public function getRegisterTableCommand($tableConfigurationArray);
	
	public function getRegisterRelationsCommand($name, $relationsArray);
}
