<?php declare(strict_types=1);

namespace h4kuna\Serialize;

interface Driver
{
	/**
	 * @param mixed $value
	 */
	static function encode($value): string;


	/**
	 * @return mixed
	 */
	static function decode(string $value);

}
