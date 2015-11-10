<?php

namespace AppBuilder\Models\ExceptionHandler\Strategies;

use AppBuilder\Models\Messager;
/**
 * Strategy wich handle sql-syntax error 
 *
 * @author vlad
 */
class SqlSyntaxError extends ExceptionStrategy {

	public function process()
	{
		$exceptionMessage = $this->thrownsException->getMessage();
		Messager::getInstance()->showMessage('SQL SYNTAX ERROR: ' . $exceptionMessage . PHP_EOL . "ABORTED!", Messager::FAILURE);
		\Yii::$app->end();
	}

}
