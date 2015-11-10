<?php

namespace AppBuilder\Factories\Generators;
use yii\gii\Generator as AbstractGiiGenerator;
/**
 * Description of GeneratorsAbstractFactory
 *
 * @author vlad
 */
abstract class AbstractFactory {

	const MODEL_GENERATOR_FACTORY = 'model';
	const CRUD_GENERATOR_FACTORY = 'crud';
	const MODULE_GENERATOR_FACTORY = 'module';

	public static function getGeneratorsFactory($factoryName)
	{
		switch ($factoryName) {
		
			case self::MODEL_GENERATOR_FACTORY:
				return new ModelGeneratorFactory();
				
			case self::CRUD_GENERATOR_FACTORY:
				return new CrudGeneratorFactory();
				
			case self::MODULE_GENERATOR_FACTORY:
				return new ModuleGeneratorFactory();
		}
		
		 throw new Exception('Bad factory value');
	}
	
	
	abstract function getGenerator($modulesConfigurationArray);
	
	abstract function getDestroyer($modulesConfigurationArray);
	
	protected function getFilledGennerator(AbstractGiiGenerator $generator, $fields)
	{
		foreach ($fields as $fieldName => $fieldValue) {
			if (property_exists($generator, $fieldName)) {
				$generator->{$fieldName} = $fieldValue;
			}
		}
		return $generator;
	}
}
