<?php

namespace AppBuilder\Models\Generators;

use AppBuilder\Models\Messager;

/**
 * Description of CrudDestroyer
 *
 * @author vlad
 */
class CrudDestroyer extends AbstractDestroyer {

	public function isGenerated()
	{
		return file_exists($this->getControllerName());
	}

	public function destroy()
	{
		$filename = $this->getControllerName();
		if($this->isGenerated()){
			$this->removeController()->removeViews();
			return true;
		}
		
		Messager::getInstance()->showMessage("CRUD {$filename} isn't generated", Messager::NOTE);
	}

	protected function getControllerName()
	{
		$moduleNamespace = $this->configuration['controller_class'];
		return $this->convertNamespaceToPath($moduleNamespace) . '.php';
	}
	
	protected function removeController(){
		$filename = $this->getControllerName();
		unlink($filename);
		return $this;
	}
	
	protected function removeViews(){
		$dirname = $this->convertNamespaceToPath($this->configuration['view_path']);
		$this->recoursiveRemoveDirectory($dirname);
		Messager::getInstance()->showMessage("CRUD {$dirname} removed", Messager::SUCCSESS);
		return $this;
	}

}
