<?php declare(strict_types=1);

namespace h4kuna\Serialize;

use h4kuna\Serialize\Driver\SetUp;
use h4kuna\Serialize\Exception\InvalidStateException;
use Nette\StaticClass;

final class Serialize implements Driver
{
	use StaticClass;

	/** @var class-string<Driver> */
	private static string $driver = SetUp::class;

	/**
	 * @param class-string<Driver> $driver
	 */
	public static function setUp(string $driver): void
	{
		if (self::$driver !== SetUp::class) {
			if (self::$driver === $driver) {
				return;
			}
			throw new InvalidStateException(sprintf('Driver was already set up "%s" and you want "%s".', self::$driver, $driver));
		}
		self::$driver = $driver;
	}


	public static function encode($value): string
	{
		return (self::$driver)::encode($value);
	}


	public static function decode(string $value)
	{
		return (self::$driver)::decode($value);
	}
}
