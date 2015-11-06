<?php

namespace AppBuilder;
use AppBuilder\Models\GlobalGenerator;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;


/**
 * @author Sirenko Vlad
 */
class Module extends BaseModule implements BootstrapInterface
{
    public $controllerNamespace = 'AppBuilder';
 
    public function init()
    {
        parent::init();
    }
 
    public function bootstrap($app)
    {
		$this->registerDependencies();
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap[$this->id] = [
                'class' => 'AppBuilder\Controllers\AppBuilderController',
                'module' => $this,
            ];
        }
    }
	
	public function registerDependencies(){
		GlobalGenerator::registerDependencies();
	}
}
