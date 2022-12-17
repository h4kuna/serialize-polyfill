<?php declare(strict_types=1);

namespace h4kuna\Serialize;

interface Driver
{
	/**
	 * @param mixed $value
	 */
	static function encode($value): string;


	/**
	 * @param array<string, mixed> $options
	 * @return mixed
	 */
	static function decode(string $value, array $options = []);

}
