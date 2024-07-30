<?php declare(strict_types=1);

namespace h4kuna\Serialize;

use h4kuna\Serialize\Exception\InvalidStateException;
use Nette\StaticClass;

final class Base64
{
	use StaticClass;

	/** @param mixed $value */
	public static function encode($value): string
	{
		return base64_encode(Serialize::encode($value, __CLASS__));
	}


	/** @return mixed */
	public static function decode(string $value, bool $strict = true)
	{
		$base = base64_decode($value, $strict);
		if ($base === false) {
			throw new InvalidStateException(sprintf('This is not valid base64 string. "%s"', $value));
		}

		return Serialize::decode($base, __CLASS__);
	}

}
