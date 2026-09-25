<?php declare(strict_types = 1);

namespace h4kuna\Serialize\Tests\Driver;

use h4kuna\Serialize\Driver\IgBinary;
use h4kuna\Serialize\Driver\Php;
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
	 *
	 * @dataProvider dataBasicTypes
	 */
	public function testEncodeDecode($value): void
	{
		Assert::same($value, IgBinary::decode(IgBinary::encode($value)));
	}

	/**
	 * @param mixed $value
	 *
	 * @dataProvider dataBasicTypes
	 */
	public function testFallback($value): void
	{
		Assert::same($value, IgBinary::decode(Php::encode($value)));
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
