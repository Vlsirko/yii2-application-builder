<?php

namespace AppBuilder\Factories\Generators;
use AppBuilder\Models\Messager;
/**
 * Description of ModelGeneratorFactory
 *
 * @author vlad
 */
class ModelGeneratorFactory extends AbstractFactory{
	
	public function getGenerator($params){
		
		$generator = \Yii::$container->get('ModelGenerator');
		
		$fillFields = [
			'tableName' => $params['table_name'],
			"modelClass" => isset($params['model_class']) ? $params['model_class'] : '',
			"ns" => isset($params['model_namespace']) ? $params['model_namespace'] : '',
			'generateRelations' => true,
			'generateLabelsFromComments' => true,
			'baseClass' => $params['model_base_class']
		];
		
		Messager::getInstance()->showMessage("Generating model for {$params['table_name']}");
		return $this->getFilledGennerator($generator, $fillFields);
	}
}
