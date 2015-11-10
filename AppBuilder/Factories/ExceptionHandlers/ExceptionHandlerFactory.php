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

	const SQL_TABLE_EXISTS = 1050;
	const SQL_TABLE_NOT_EXISTS = 1051;
	const SQL_SYNTAX_ERROR = 1064;
	const SQL_INDEX_EXISTS = 1022;
	const SQL_INDEX_NOT_EXISTS = 1146;

	public static function getHandlerViaException(\Exception $e)
	{
		$info = $e->errorInfo;
		$strategy = self::getHandlerStrategyViaExceptionCode($info[1]);
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
			case self::SQL_TABLE_NOT_EXISTS:
				return new Strategies\SqlTableNotExists();
			case self::SQL_INDEX_NOT_EXISTS:
				return new Strategies\SqlIndexNotExists();
		}

		throw new \Exception("Undefined exception code in ExceptionHandlerFactory {$code}");
	}

}
