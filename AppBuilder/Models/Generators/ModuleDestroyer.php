<?php

namespace AppBuilder\Models\Generators;

use AppBuilder\Models\Messager;

/**
 * Description of ModuleDestroyer
 *
 * @author vlad
 */
class ModuleDestroyer extends AbstractDestroyer {

	public function isGenerated()
	{
		return file_exists($this->getFileName());
	}

	public function destroy()
	{
		$filename = $this->getFileName();
		if($this->isGenerated()){
			$dirname = dirname($filename);
			$this->recoursiveRemoveDirectory($dirname);
			Messager::getInstance()->showMessage("Module {$filename} removed", Messager::SUCCSESS);
			return true;
		}
		
		Messager::getInstance()->showMessage("Module {$filename} isn't created", Messager::NOTE);
	}

	protected function getFileName()
	{
		$moduleNamespace = $this->configuration['module_class'];
		return $this->convertNamespaceToPath($moduleNamespace) . '.php';
	}

}
