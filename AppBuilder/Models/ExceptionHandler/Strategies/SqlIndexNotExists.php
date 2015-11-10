<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBuilder\Models\ExceptionHandler\Strategies;

use AppBuilder\Models\Messager;
/**
 * Description of SqlIndexNotExists
 *
 * @author vlad
 */
class SqlIndexNotExists extends ExceptionStrategy{
	public function process(){
		Messager::getInstance()->showMessage('Index not exists', Messager::NOTE);
	}
}
