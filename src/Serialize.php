<?php declare(strict_types = 1);

namespace h4kuna\Serialize;

use h4kuna\Serialize\Driver\SetUp;
use h4kuna\Serialize\Exception\InvalidStateException;
use Nette\StaticClass;
use function sprintf;

/**
 * How use caseId @see Base64
 */
final class Serialize
{

	use StaticClass;

	private const DEFAULT_DRIVER_ID = '';

	/**
	 * @var array<string, class-string<Driver>>
	 */
	private static array $cases = [
		self::DEFAULT_DRIVER_ID => SetUp::class,
	];

	/**
	 * @param class-string<Driver> $driver
	 * @param array<non-empty-string, class-string<Driver>> $cases
	 */
	public static function setUp(
		string $driver,
		array $cases = [],
	): void
	{
		if (self::$cases[self::DEFAULT_DRIVER_ID] !== SetUp::class) {
			if (self::$cases[self::DEFAULT_DRIVER_ID] === $driver) {
				return;
			}
			throw new InvalidStateException(sprintf('Driver was already set up "%s" and you want "%s".', self::$cases[self::DEFAULT_DRIVER_ID], $driver));
		}
		$cases[self::DEFAULT_DRIVER_ID] = $driver;
		self::$cases = $cases;
	}

	/**
	 * @param string $caseId - is for control what driver is used and programmer can change it per use case
	 */
	public static function encode(
		mixed $value,
		string $caseId = self::DEFAULT_DRIVER_ID,
	): string
	{
		return self::resolveDriver($caseId)::encode($value);
	}

	/**
	 * @param string $caseId - is for control what driver is used and programmer can change it per use case
	 */
	public static function decode(
		string $value,
		string $caseId = self::DEFAULT_DRIVER_ID,
	): mixed
	{
		return self::resolveDriver($caseId)::decode($value);
	}

	/**
	 * @return class-string<Driver>
	 */
	private static function resolveDriver(string $caseId): string
	{
		return self::$cases[$caseId] ?? self::$cases[self::DEFAULT_DRIVER_ID];
	}

}
