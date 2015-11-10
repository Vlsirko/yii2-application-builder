<?php

namespace AppBuilder\Factories\Generators;

use AppBuilder\Models\Messager;

/**
 * Description of moduleGeneratorFactory
 *
 * @author vlad
 */
class ModuleGeneratorFactory extends AbstractFactory {

	public function getGenerator($params)
	{

		$fillFields = [
			'moduleClass' => isset($params['module_class']) ? $params['module_class'] : '',
			'moduleId' => isset($params['module_id']) ? $params['module_id'] : ''
		];

		$generator = $this->getFilledGennerator(\Yii::$container->get('ModuleGenerator'), $fillFields);

		$generator->on("AFTER_CREATE", [$this, 'afterModuleCreateCallback'], $fillFields['moduleClass']);

		return $generator;
	}

	public function afterModuleCreateCallback($event)
	{
		$moduleNamespace = $event->data;
		$moduleName = $this->getModuleClass($moduleNamespace);
		Messager::getInstance()->showMessage('Add  "' . $moduleName . ' to config ');
		$this->addModuleToConfig($moduleName, $moduleNamespace);
	}

	protected function addModuleToConfig($moduleName, $moduleNamespace)
	{
		/**
		 * TODO: rewrite this method to config loader
		 */
	}

	protected function getModuleClass($namespace)
	{
		return array_pop(explode('\\', $namespace));
	}

}
