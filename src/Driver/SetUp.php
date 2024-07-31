<?php declare(strict_types=1);

namespace h4kuna\Serialize\Driver;

use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Serialize;
use Nette\StaticClass;

/**
 * @internal
 */
final class SetUp implements Driver
{
	use StaticClass;

	public static function encode($value): string
	{
		return self::boot()::encode($value);
	}

	public static function decode(string $value)
	{
		return self::boot()::decode($value);
	}

	/**
	 * @return class-string<Driver>
	 */
	private static function boot(): string
	{
		$class = Php::class;
		Serialize::setUp($class);
		return $class;
	}
}
