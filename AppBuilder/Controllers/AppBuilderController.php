<?php

namespace AppBuilder\Controllers;

use yii\console\Controller;
use AppBuilder\Models\Messager;
use AppBuilder\Factories\CommandFactory;
use AppBuilder\Factories\ExceptionHandlers\ExceptionHandlerFactory;

/**
 * Description of AppBuilderController
 *
 * @author Vlad Sirenko
 */
class AppBuilderController extends Controller {

	public function actionIndex($commandName)
	{
		try {
			$currentCommand = CommandFactory::getCommand($commandName);
			Messager::getInstance()->confirm('Are you sure you want to do this? Type "yes" to continue', Messager::WARNING);
			$currentCommand->execute();
		} catch (\Exception $e) {
			ExceptionHandlerFactory::getHandlerViaException($e)->handle();
		}
	}

}
