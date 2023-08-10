<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests\Driver;

use h4kuna\Serialize\Driver;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class IgBinaryTest extends TestCase
{

	/**
	 * @param mixed $value
	 * @dataProvider dataBasicTypes
	 */
	public function testEncodeDecode($value): void
	{
		Assert::same($value, Driver\IgBinary::decode(Driver\IgBinary::encode($value)));
	}

	/**
	 * @param mixed $value
	 * @dataProvider dataBasicTypes
	 */
	public function testFallback($value): void
	{
		Assert::same($value, Driver\IgBinary::decode(Driver\Php::encode($value)));
	}


	/**
	 * @return array<array<string, mixed>>
	 */
	public function dataBasicTypes(): array
	{
		return testValues();
	}

}

(new IgBinaryTest())->run();
