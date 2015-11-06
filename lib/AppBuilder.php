<?php

namespace AppBuilder;

use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;

/**
 * @author Sirenko Vlad
 */
class AppBuilder extends BaseModule implements BootstrapInterface
{
    public $controllerNamespace = 'AppBuilder';
 
    public function init()
    {
        parent::init();
    }
 
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap[$this->id] = [
                'class' => 'AppBuilder\AppBuilderController',
                'module' => $this,
            ];
        }
    }
}
