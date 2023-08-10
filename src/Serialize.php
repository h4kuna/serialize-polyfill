<?php declare(strict_types=1);

namespace h4kuna\Serialize;

use Closure;

final class Serialize implements Driver
{

	/**
	 * @var Closure
	 */
	private static $encode;

	/**
	 * @var Closure
	 */
	private static $decode;


	public static function setUp(Driver $driver): void
	{
		self::$encode = static fn ($value) => $driver::encode($value);
		self::$decode = static fn (string $value) => $driver::decode($value);
	}


	public static function encode($value): string
	{
		return (self::$encode)($value);
	}


	public static function decode(string $value)
	{
		return (self::$decode)($value);
	}

}
