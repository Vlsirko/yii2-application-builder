<?php

namespace AppBuilder\Models\Generators;

/**
 * Description of DestroyerInterface
 *
 * @author vlad
 */
abstract class AbstractDestroyer {

	protected $configuration;

	public function __construct($moduleConfiguration)
	{
		$this->configuration = $moduleConfiguration;
	}

	protected function removeFile(CodeFile $file)
	{
		if (file_exists($file->path)) {
			unlink($file->path);
		}
	}

	protected function recoursiveRemoveDirectory($dir)
	{

		$files = array_diff(scandir($dir), array('.', '..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? $this->recoursiveRemoveDirectory("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	}

	protected function getParrentDir($dir)
	{
		$parts = explode(DIRECTORY_SEPARATOR, $dir);
		array_pop($parts);
		return implode(DIRECTORY_SEPARATOR, $parts);
	}

	protected function convertNamespaceToPath($namespace)
	{
		return str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
	}

	abstract public function destroy();

	abstract public function isGenerated();
}
