<?php declare(strict_types=1);

namespace h4kuna\Serialize;

use h4kuna\Serialize\Driver\SetUp;
use h4kuna\Serialize\Exception\InvalidStateException;
use Nette\StaticClass;

/**
 * How use caseId @see Base64
 */
final class Serialize
{
	use StaticClass;
	private const DefaultDriverId = '';

	/** @var array<string, class-string<Driver>> */
	private static array $cases = [
		self::DefaultDriverId => SetUp::class
	];

	/**
	 * @param class-string<Driver>                          $driver
	 * @param array<non-empty-string, class-string<Driver>> $cases
	 */
	public static function setUp(string $driver, array $cases = []): void
	{
		if (self::$cases[self::DefaultDriverId] !== SetUp::class) {
			if (self::$cases[self::DefaultDriverId] === $driver) {
				return;
			}
			throw new InvalidStateException(sprintf('Driver was already set up "%s" and you want "%s".', self::$cases[self::DefaultDriverId], $driver));
		}
		$cases[self::DefaultDriverId] = $driver;
		self::$cases = $cases;
	}

	/**
	 * @param mixed  $value
	 * @param string $caseId - is for control what driver is used and programmer can change it per use case
	 */
	public static function encode($value, string $caseId = self::DefaultDriverId): string
	{
		return self::resolveDriver($caseId)::encode($value);
	}


	/**
	 * @param string $caseId - is for control what driver is used and programmer can change it per use case
	 *
	 * @return mixed
	 */
	public static function decode(string $value, string $caseId = self::DefaultDriverId)
	{
		return self::resolveDriver($caseId)::decode($value);
	}

	/**
	 * @return class-string<Driver>
	 */
	private static function resolveDriver(string $caseId): string
	{
		return self::$cases[$caseId] ?? self::$cases[self::DefaultDriverId];
	}
}
