<?php

use Tester\Assert;

define('SERIALIZATION_FORCE_DISABLE', true);

require_once __DIR__ . '/../vendor/autoload.php';

class BasicTest extends \Tester\TestCase
{

	/**
	 * @dataProvider dataBackCompatibility
	 */
	public function testBackCompatibility($value)
	{
		$data = igbinary_serialize($value);
		Assert::same($value, deserialization($data));
	}


	public function testForwardCompatibilityFalse()
	{
		Assert::false(deserialization(serialization(false)));
		@unlink('foo');
		Assert::false(deserialization(serialization(false)));
	}


	public function dataBackCompatibility()
	{
		return [
			['value' => ['foo' => 1],],
			['value' => null],
			['value' => 0],
			['value' => 1],
			['value' => false],
		];
	}

}

(new BasicTest)->run();
