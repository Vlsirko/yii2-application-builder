
**yii2-application-builder**
=======

> *This is beta version, and may contain some bugs

This extention allows you to generate tables, models, CRUD's and modules via JSON file.
This is same with gii code generator, but you don't need to do this manually. You can fill json 
file as you need and generate code via one command in console



**Requirements:**
	 1. Yii2 framework (basic or advanced template)
	 2. Yii2 gii module


----------

**Instalation via composer:**
-----------------------------

 1. Add to yours *composer.json* in "require-dev" field:
	   
	     "Vlsirko/yii2-application-builder" : "dev-master"
 2. 	Add to yours *composer.json* in "repositories" field:

			{
				"url" : "https://github.com/Vlsirko/yii2-application-builder.git",
				"type" : "git"
			}
 3. Run *./composer.phar update* in shell
 4. Change your configuration file:
	 
> **For advanced template**

Open *console/config/main.php* file and in field "bootstrap" add "app_builder":

`'bootstrap' => ['log', 'app_builder']`

Add to "modules" field installed module:
  
    'modules' => [
		'app_builder' => [
			'class' => 'AppBuilder\Module',
		]
	],
	


----------


> **For basic template**

**TODO**


----------

**Usage:**
----------

**Generating application:**
 1. Create *app_structure.json* file and put it into your app config directory
 2. Fill this file like in [sample](https://github.com/Vlsirko/yii2-application-builder/blob/master/samples/app_structure_sample.json)
 3. Run yii2 console app:
 
    $./yii app_builder generate

**Rollback changes:**
Run next command in yii2 base directory:

    $ ./yii app_builder rollback


**Set your own code generators:**
If you need to redefine standart code generators, you must follow by next steps:
1. Create *app_dependencies.json* file in console config directory;
2. FIll this file like this [sample](https://github.com/Vlsirko/yii2-application-builder/blob/master/samples/app_dependencies.json);
>**WARNING!**
>Your own class must be an instance of  yii\gii\Generator