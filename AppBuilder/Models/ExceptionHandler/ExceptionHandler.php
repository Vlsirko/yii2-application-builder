<?php

namespace AppBuilder\Models\ExceptionHandler;

use AppBuilder\Models\ExceptionHandler\Strategies\ExceptionStrategy;

/**
 * Description of ExceptionHandler
 *
 * @author vlad
 */
class ExceptionHandler {

	private $handleStrategy;

	public function __construct(ExceptionStrategy $strategy)
	{
		$this->handleStrategy = $strategy;
	}

	public function handle()
	{
		$this->handleStrategy->process();
	}

}
