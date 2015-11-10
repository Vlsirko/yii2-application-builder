<?php

namespace AppBuilder\Models\AppBuilder\Strategies;

use AppBuilder\Factories\Generators\AbstractFactory as GeneratorFactory;
use AppBuilder\Factories\TableGeneratorStrategyFactory;
use AppBuilder\Factories\TableGeneratorFactory;
use AppBuilder\Models\ConfigLoader;
use AppBuilder\Models\Messager;
use yii\gii\CodeFile;

/**
 * Description of Rollback
 *
 * @author Sirenko Vlad
 */
class Rollback extends AbstractAppBuilderStrategy {

	public function processingTables()
	{
		TableGeneratorFactory::getGenerator($this->modulesConfiguration, TableGeneratorStrategyFactory::COMMAND_ROLLBACK)
			->generate();
		return $this;
	}

	public function processingModules()
	{
		foreach ($this->modulesConfiguration as $module) {
			$toGenerate = ConfigLoader::getInstance()->getAvaliableEntitiesFromConfig($module);
			$toGenerateReversed = array_reverse($toGenerate);
			foreach ($toGenerateReversed as $entity) {
				$this->drop($entity, $module);
			}
		}
		return $this;
	}

	protected function drop($type, $modelParamsArray)
	{
		$generator = GeneratorFactory::getGeneratorsFactory($type)->getGenerator($modelParamsArray[$type]);
		$this->removeGeneratedFiles($generator->generate());
		$generator->trigger('AFTER_DELETE');
	}

	protected function removeGeneratedFiles($files)
	{
		foreach ($files as $file) {
			$this->removeFile($file);
			$this->recoursiveRemoveDirectory(dirname($file->path));
			Messager::getInstance()->showMessage($file->path . ' succesfully removed', Messager::SUCCSESS);
		}
	}

	protected function removeFile(CodeFile $file)
	{
		if (file_exists($file->path)) {
			unlink($file->path);
		}
	}

	protected function recoursiveRemoveDirectory($dir)
	{
		if(is_dir($dir)){
			if(count(scandir($dir)) == 2){
				rmdir($dir);
				$this->recoursiveRemoveDirectory($this->getParrentDir($dir));
			}
		}
	}
	
	protected function getParrentDir($dir){
		$parts = explode(DIRECTORY_SEPARATOR, $dir);
		array_pop($parts);
		return implode(DIRECTORY_SEPARATOR, $parts);
	}

	public function process()
	{
		$this->processingModules()->processingTables();
	}

}
