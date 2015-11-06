Create modules from JSON
========================
This ext allows you to create all modules and databases tables via json file

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vlsirko/yii2-application-builder "*"
```

or add

```
"vlsirko/yii2-application-builder": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \AppBuilder\AutoloadExample::widget(); ?>```