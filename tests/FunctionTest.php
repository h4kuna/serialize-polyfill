<?php

use Tester\Assert;

require_once __DIR__ . '/../vendor/autoload.php';

class BasicTest extends \Tester\TestCase
{

	/**
	 * @dataProvider dataForwardCompatibility
	 */
	public function testForwardCompatibility($value)
	{
		$data = serialize($value);
		Assert::same($value, deserialization($data));
	}


	public function testForwardCompatibilityNull()
	{
		Assert::null(deserialization(serialization(null)));
		@unlink('foo');
		Assert::null(deserialization(serialization(null)));
	}


	public function dataForwardCompatibility()
	{
		return [
			['value' => ['foo' => 1],],
			['value' => null],
			['value' => 0],
			['value' => 1],
		];
	}

}

(new BasicTest)->run();
