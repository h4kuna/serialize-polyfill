<?php declare(strict_types=1);

namespace h4kuna\Serialize\Driver;

use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Exception\InvalidStateException;

final class IgBinary implements Driver
{
	private const NULL = "\x00";

	/**
	 * @var array<string>
	 */
	private static array $haystack = ["\x00\x00\x00\x01", "\x00\x00\x00\x02"];


	public static function encode($value): string
	{
		if ($value === null) {
			$value = self::NULL;
		}
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
			assert($error !== null);
			error_clear_last();
			if (self::serializationCheckIgbinary($value) === false) {
				return Php::decode($value); // fallback to native serialize
			}

			throw new InvalidStateException($error['message']);
		} elseif ($data === self::NULL) {
			return null;
		}

		return $data;
	}


	public static function serializationCheckIgbinary(string $value): bool
	{
		return in_array(mb_substr($value, 0, 4), self::$haystack, true);
	}

}
