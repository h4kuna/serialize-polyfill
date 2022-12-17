<?php declare(strict_types=1);

namespace h4kuna\Serialize;

final class Serialize implements Driver
{

	/**
	 * @var \Closure
	 */
	private static $encode;

	/**
	 * @var \Closure
	 */
	private static $decode;


	public static function setUp(Driver $driver): void
	{
		self::$encode = static fn ($value) => $driver::encode($value);
		self::$decode = static fn (string $value, array $options) => $driver::decode($value, $options);
	}


	public static function encode($value): string
	{
		return (self::$encode)($value);
	}


	public static function decode(string $value, array $options = [])
	{
		return (self::$decode)($value, $options);
	}

}
