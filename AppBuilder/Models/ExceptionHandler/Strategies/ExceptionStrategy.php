<?php

namespace AppBuilder\Models\ExceptionHandler\Strategies;

/**
 *
 * @author Sirenko Vlad
 */
abstract class ExceptionStrategy {
	
	protected $thrownsException;
	
	abstract public function process();
	
	public function setException(\Exception $e){
		$this->thrownsException = $e;
	}
}
