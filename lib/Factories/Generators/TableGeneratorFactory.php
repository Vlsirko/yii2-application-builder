<?php

namespace AppBuilder\Factories\Generators;

/**
 * Description of TableGeneratorFactory
 *
 * @author vlad
 */
class TableGeneratorFactory extends AbstractFactory{
	
	public function getGenerator($params){
		$generator = \Yii::$container->get('TableGenerator');
		$generator->parseConfiguration($params);
		return $generator;
	}
}
