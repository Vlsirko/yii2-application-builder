<?php
namespace AppBuilder\Models\Commands;

use AppBuilder\Models\ConfigLoader;

/**
 *
 * @author Sirenko Vlad
 */
abstract class  AbstractCommand {
	
	
	protected $modulesConfig;
	
	public function __construct(){
		$this->modulesConfiguration = ConfigLoader::getInstance()->getModuleConfiguration();
	}

	abstract public function execute();
}
