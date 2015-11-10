<?php

namespace AppBuilder\Models\Generators;

use AppBuilder\Models\Messager;

/**
 * Description of ModelDestroyer
 *
 * @author vlad
 */
class ModelDestroyer extends AbstractDestroyer {

	public function isGenerated()
	{
		return file_exists($this->getFileName());
	}

	public function destroy()
	{
		$filename = $this->getFileName();
		if ($this->isGenerated()) {
			unlink($filename);
			Messager::getInstance()->showMessage("Model {$filename} removed", Messager::SUCCSESS);
			return true;
		}

		Messager::getInstance()->showMessage("MODEL {$filename} isn't generated", Messager::NOTE);
	}

	protected function getFileName()
	{
		$moduleNamespace = $this->configuration['model_namespace'] . '\\' . $this->configuration['model_class'];
		return $this->convertNamespaceToPath($moduleNamespace) . '.php';
	}

}
