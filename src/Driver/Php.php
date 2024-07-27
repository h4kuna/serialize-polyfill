<?php declare(strict_types=1);

namespace h4kuna\Serialize\Driver;

use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Exception\InvalidStateException;
use Nette\StaticClass;

final class Php implements Driver
{
	use StaticClass;

	/** @var array{allowed_classes?: bool, max_depth?: int} */
	public static array $options = [];


	public static function encode($value): string
	{
		return serialize($value);
	}


	public static function decode(string $value)
	{
		$data = @unserialize($value, self::$options);
		if ($data === false) {
			$error = error_get_last();
			if ($error === null) {
				return false;
			}
			error_clear_last();
			if (IgBinary::serializationCheckIgbinary($value) === true) {
				return IgBinary::decode($value);
			}

			throw new InvalidStateException($error['message']);
		}

		return $data;
	}

}
