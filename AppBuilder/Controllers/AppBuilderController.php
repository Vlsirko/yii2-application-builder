<?php

namespace AppBuilder\Controllers;

use yii\console\Controller;
use AppBuilder\Models\Messager;
use AppBuilder\Factories\AppBuilderFactory;

/**
 * Description of AppBuilderController
 *
 * @author Vlad Sirenko
 */
class AppBuilderController extends Controller {

	public function actionIndex($command)
	{
		///try {
			$appBuilder = AppBuilderFactory::getAppBuilderByCommand($command);
			Messager::getInstance()->confirm('Are you sure you want to do this? Type "yes" to continue', Messager::WARNING);
			$appBuilder->run();
		/*} catch (\Exception $e) {
			Messager::getInstance()->showMessage($e->getMessage(), Messager::FAILURE);
			\Yii::$app->end();
		}*/
	}

}
