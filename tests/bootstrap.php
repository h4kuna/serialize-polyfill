<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * @return array<array<string, mixed>>
 */
function testValues(): array
{
	return [
		['value' => [],],
		['value' => null],
		['value' => 0],
		['value' => ''],
		['value' => 0.0],
		['value' => false],
		['value' => ['foo' => 1],],
		['value' => 1],
		['value' => 'foo'],
		['value' => 0.1],
		['value' => true],
	];
}


Tester\Environment::setup();
