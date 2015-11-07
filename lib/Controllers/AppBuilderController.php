<?php

namespace AppBuilder\Controllers;

use yii\console\Controller;
use AppBuilder\Models\Messager;
use AppBuilder\Models\ConfigLoader;
use AppBuilder\Models\AppBuilder;

/**
 * Description of AppBuilderController
 *
 * @author Vlad Sirenko
 */
class AppBuilderController extends Controller {

	public function actionGenerate()
	{

		try {
			Messager::getInstance()->confirm('Are you sure you want to do this? Type "yes" to continue', Messager::WARNING);
			$modulesConfiguration = ConfigLoader::getInstance()->getModuleConfiguration();

			\Yii::$container->get('AppBuilder\Models\AppBuilder', [], AppBuilder::getDependencies())
					->setConfiguration($modulesConfiguration)
					->run();
		} catch (\Exception $e) {
			Messager::getInstance()->showMessage($e->getMessage(), Messager::FAILURE);
			\Yii::$app->end();
		}
	}

}
