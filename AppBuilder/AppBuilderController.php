<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBuilder;

/**
 * Description of AppBuilderController
 *
 * @author vlad
 */
class AppBuilderController {
	
	public function actionIndex($message = 'hello world from module')
    {
        echo $message . "\n";
    }
}
