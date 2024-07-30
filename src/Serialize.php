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

	/** @var class-string<Driver> */
	private static string $driver = SetUp::class;

	/** @var array<non-empty-string, class-string<Driver>> */
	private static array $cases = [];

	/**
	 * @param class-string<Driver> $driver
	 * @param array<non-empty-string, class-string<Driver>> $cases
	 */
	public static function setUp(string $driver, array $cases = []): void
	{
		if (self::$driver !== SetUp::class) {
			if (self::$driver === $driver) {
				return;
			}
			throw new InvalidStateException(sprintf('Driver was already set up "%s" and you want "%s".', self::$driver, $driver));
		}
		self::$driver = $driver;
		self::$cases = $cases;
	}

	/**
	 * @param mixed            $value
	 * @param non-empty-string $caseId - is for control what driver is used and programmer can change it per use case
	 */
	public static function encode($value, string $caseId): string
	{
		return self::resolveDriver($caseId)::encode($value);
	}


	/**
	 * @param non-empty-string $caseId - is for control what driver is used and programmer can change it per use case
	 *
	 * @return mixed
	 */
	public static function decode(string $value, string $caseId)
	{
		return self::resolveDriver($caseId)::decode($value);
	}

	/**
	 * @return class-string<Driver>
	 */
	private static function resolveDriver(string $caseId): string
	{
		return self::$cases[$caseId] ?? self::$driver;
	}
}
