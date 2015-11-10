<?php

namespace AppBuilder\Models\AppBuilder;

use AppBuilder\Models\AppBuilder\Strategies\AbstractAppBuilderStrategy;

/**
 * Responsible for creating and removing modules
 * @author Sirenko Vlad
 */
class AppBuilder {

	private $strategy;

	public function __construct(AbstractAppBuilderStrategy $strategy)
	{
		$this->strategy = $strategy;
	}

	public function run()
	{
		$this->strategy->process($this);
	}

}
