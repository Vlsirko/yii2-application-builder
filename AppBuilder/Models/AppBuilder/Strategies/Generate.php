<?php

namespace AppBuilder\Models\AppBuilder\Strategies;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorFactory;
use yii\gii\CodeFile;
use AppBuilder\Models\Messager;
use AppBuilder\Models\ConfigLoader;
use AppBuilder\Factories\TableGeneratorFactory;
use AppBuilder\Factories\TableGeneratorStrategyFactory;

/**
 * Description of Generate
 *
 * @author Sirenko Vlad
 */
class Generate extends AbstractAppBuilderStrategy {

	public function processingTables()
	{
		TableGeneratorFactory::getGenerator($this->modulesConfiguration, TableGeneratorStrategyFactory::COMMAND_GENERATE)
			->generate();
		return $this;
	}

	public function processingModules()
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
