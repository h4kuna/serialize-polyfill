<?php declare(strict_types = 1);

namespace h4kuna\Serialize;

use h4kuna\Serialize\Exception\InvalidStateException;
use Nette\StaticClass;
use function base64_decode;
use function base64_encode;
use function sprintf;

final class Base64
{

	use StaticClass;

	public static function encode(mixed $value): string
	{
		return base64_encode(Serialize::encode($value, self::class));
	}

	public static function decode(
		string $value,
		bool $strict = true,
	): mixed
	{
		$base = base64_decode($value, $strict);
		if ($base === false) {
			throw new InvalidStateException(sprintf('This is not valid base64 string. "%s"', $value));
		}

		return Serialize::decode($base, self::class);
	}

}
