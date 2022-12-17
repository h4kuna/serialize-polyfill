<?php declare(strict_types=1);

namespace h4kuna\Serialize\Driver;

use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Exception\InvalidStateException;

final class Php implements Driver
{
	public static function encode($value): string
	{
		return serialize($value);
	}


	public static function decode(string $value, array $options = [])
	{
		$data = @unserialize($value);
		if ($data === false) {
			$error = error_get_last();
			if ($error === null) {
				return false;
			}
			error_clear_last();

			throw new InvalidStateException($error['message']);
		}

		return $data;
	}

}
