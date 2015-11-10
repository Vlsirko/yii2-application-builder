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
	
	public $newDirMode = 0777;
	
	public $newFileMode = 0666;
 
    public function init()
    {
        parent::init();
    }
 
    public function bootstrap($app)
    {
		\Yii::setAlias("@appBuilder", __DIR__ . '/..');
		
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap[$this->id] = [
                'class' => 'AppBuilder\Controllers\AppBuilderController',
                'module' => $this,
            ];
        }
    }

}
