<?php
namespace AppBuilder\Models\TableGenerator\Strategies;

use AppBuilder\Models\TableGenerator\TableGenerator;
/**
 * Description of TableGeneratorStrategyInterface
 *
 * @author Sirenko Vlad
 */
interface TableGeneratorStrategyInterface {
	
	public function getRegisterTableCommand($tableConfigurationArray);
	
	public function getRegisterRelationsCommand($name, $relationsArray);
	
	public function execCommands(TableGenerator $generator);
	
	public function getName();
}
