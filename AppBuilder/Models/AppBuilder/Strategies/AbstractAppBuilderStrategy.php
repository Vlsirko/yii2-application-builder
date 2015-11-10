<?php
namespace AppBuilder\Models\AppBuilder\Strategies;

use AppBuilder\Models\ConfigLoader;
use AppBuilder\Models\AppBuilder\AppBuilder;
/**
 *
 * @author Sirenko Vlad
 */
abstract class  AbstractAppBuilderStrategy {
	
	
	protected $modulesConfig;
	
	public function __construct(){
		$this->modulesConfiguration = ConfigLoader::getInstance()->getModuleConfiguration();
	}
	
	//abstract public function processingTables();
	
	//abstract public function processingModules();
	
	abstract public function process();
}
