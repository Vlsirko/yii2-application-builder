<?php

namespace AppBuilder\Factories\ExceptionHandlers;

use AppBuilder\Models\ExceptionHandler\ExceptionHandler;
use AppBuilder\Models\ExceptionHandler\Strategies;

/**
 * Factory responsible for creating ExceptionHandler 
 * Create instance of SqlExceptionHandler and add to it
 * handler strategy
 *
 * @author Sirenko Vlad
 */
class ExceptionHandlerFactory {

	const SQL_TABLE_EXISTS = 42;
	const SQL_SYNTAX_ERROR = 42000;
	const SQL_INDEX_EXISTS = 23000;

	public static function getHandlerViaException(\Exception $e)
	{
		$strategy = self::getHandlerStrategyViaExceptionCode($e->getCode());
		$strategy->setException($e);
		return new ExceptionHandler($strategy);
	}

	private static function getHandlerStrategyViaExceptionCode($code)
	{
		switch ($code) {
			case self::SQL_TABLE_EXISTS:
				return new Strategies\SqlTableExists();
			case self::SQL_SYNTAX_ERROR:
				return new Strategies\SqlSyntaxError();
			case self::SQL_INDEX_EXISTS:
				return new Strategies\SqlIndexExists();
		}

		throw new \Exception("Undefined exception code in ExceptionHandlerFactory {$code}");
	}

}
