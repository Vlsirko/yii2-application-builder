<?php

namespace AppBuilder\Models;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorFactory;
use yii\base\Object;
use yii\gii\CodeFile;
use AppBuilder\Models\Messager;

/**
 * Responsible for creating modules
 * @author Sirenko Vlad
 */
class AppBuilder extends Object {

	private $modulesConfiguration;

	public function run()
	{
		$this->modulesConfiguration = ConfigLoader::getInstance()->getModuleConfiguration();
		$this->creatingTables()->creatingInstances();
	}

	protected function creatingTables()
	{
		GeneratorFactory::getGeneratorsFactory(GeneratorFactory::TABLE_GENERATOR_FACTORY)
			->getGenerator($this->modulesConfiguration)
			->generate();
		return $this;
	}

	protected function creatingInstances()
	{
		foreach ($this->modulesConfiguration as $module) {
			$toGenerate = ConfigLoader::getInstance()->getEntitiesToGenerate($module);
			foreach ($toGenerate as $entity) {
				$this->generate($entity, $module);
			}
		}
		return $this;
	}

	protected function generate($type, $modelParamsArray)
	{
		$generator = GeneratorFactory::getGeneratorsFactory($type)->getGenerator($modelParamsArray[$type]);
		$this->processingGeneratedFiles($generator->generate());
		$generator->trigger('AFTER_CREATE');
	}

	protected function processingGeneratedFiles($files)
	{
		foreach ($files as $file) {
			if ($file->diff() && !$this->confirmRewriteFile($file)) {
				continue;
			}
			$file->save();
			Messager::getInstance()->showMessage($file->path . ' succesfully generated', Messager::SUCCSESS);
		}
	}

	protected function confirmRewriteFile(CodeFile $file)
	{
		try {
			$question = "File '%s' exists and have some difference, "
				. "are you shure that you want to rewrite it? Type "
				. "'yes' to rewrite:";
			
			$confirmString = sprintf($question, $file->path);
			Messager::getInstance()->confirm($confirmString, Messager::WARNING);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

}
