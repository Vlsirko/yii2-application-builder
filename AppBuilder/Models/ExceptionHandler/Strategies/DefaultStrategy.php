<?php

namespace AppBuilder\Models\ExceptionHandler\Strategies;

use AppBuilder\Models\Messager;
/**
 * Description of DefaultStrategy
 *
 * @author vlad
 */
class DefaultStrategy extends ExceptionStrategy{
	
	public function process()
	{
		$message = $this->thrownsException->getMessage();
		Messager::getInstance()->showMessage($message, Messager::FAILURE);
		\Yii::$app->end();
	}
	
}
