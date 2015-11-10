<?php

namespace AppBuilder\Factories\Generators;
use AppBuilder\Models\Generators\CrudDestroyer;

/**
 * Description of CrudGeneratorFactory
 *
 * @author vlad
 */
class CrudGeneratorFactory extends AbstractFactory {

	public function getGenerator($params)
	{
		$generator = \Yii::$container->get('CrudGenerator');
		$fillFields = [
			"modelClass" =>  $params['model_class'],
			"controllerClass" => isset($params['controller_class']) ? $params['controller_class'] : '',
			"controllerBaseClass" => isset($params['controller_base_class']) ? $params['controller_base_class'] : 'yii\web\Controller',
			"viewPath" => isset($params['view_path']) ? $params['view_path'] : '',
		];
		return $this->getFilledGennerator($generator, $fillFields);
	}
	
	public function getDestroyer($modulesConfigurationArray)
	{
		return new CrudDestroyer($modulesConfigurationArray);
	}

}
