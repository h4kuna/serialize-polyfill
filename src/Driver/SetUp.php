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
		self::boot();
		return Serialize::encode($value);
	}

	public static function decode(string $value)
	{
		self::boot();
		return Serialize::decode($value);
	}

	private static function boot(): void
	{
		Serialize::setUp(Php::class);
	}
}
