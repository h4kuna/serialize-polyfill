<?php declare(strict_types=1);

namespace h4kuna\Serialize\Driver;

use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Exception\InvalidStateException;

final class IgBinary implements Driver
{
	/**
	 * @var array<string>
	 */
	private static array $haystack = ["\x00\x00\x00\x01", "\x00\x00\x00\x02"];


	public static function encode($value): string
	{
		$result = igbinary_serialize($value);
		if ($result === null) {
			$error = error_get_last();
			error_clear_last();

			throw new InvalidStateException($error['message'] ?? 'Unknown error.');
		}

		return $result;
	}


	public static function decode(string $value)
	{
		$data = @igbinary_unserialize($value);
		if ($data === null) {
			$error = error_get_last();
			error_clear_last();
			if ($error === null || self::serializationCheckIgbinary($value)) {
				return null;
			}

			throw new InvalidStateException($error['message']);
		}

		return $data;
	}


	private static function serializationCheckIgbinary(string $value): bool
	{
		return in_array(mb_substr($value, 0, 4), self::$haystack, true);
	}

}
