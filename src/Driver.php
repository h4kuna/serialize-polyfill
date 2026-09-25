<?php declare(strict_types = 1);

namespace h4kuna\Serialize;

interface Driver
{

	/** @param mixed $value */
	public static function encode($value): string;

	/** @return mixed */
	public static function decode(string $value);

}
