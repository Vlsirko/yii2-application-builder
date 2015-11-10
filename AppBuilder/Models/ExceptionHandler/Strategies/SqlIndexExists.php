<?php

namespace AppBuilder\Models\ExceptionHandler\Strategies;


use AppBuilder\Models\Messager;
/**
 * Description of SqlIndexExists
 *
 * @author Sirenko Vlad
 */
class SqlIndexExists extends ExceptionStrategy{
	
	public function process(){
		Messager::getInstance()->showMessage('Index exists', Messager::SUCCSESS);
	}
	
}
