<?php

namespace AppBuilder\Models\ExceptionHandler\Strategies;


use AppBuilder\Models\Messager;

/**
 * Handle Table Exists Exception
 *
 * @author Sirenko Vlad
 */
class SqlTableExists extends ExceptionStrategy {
	
	public function process()
	{
		Messager::getInstance()->showMessage('Table exists', Messager::NOTE);
	}

}
