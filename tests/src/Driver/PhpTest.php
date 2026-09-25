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
class PhpTest extends TestCase
{

	/**
	 * @param mixed $value
	 *
	 * @dataProvider dataBasicTypes
	 */
	public function testFallback($value): void
	{
		Assert::same($value, Php::decode(IgBinary::encode($value)));
	}

	/**
	 * @param mixed $value
	 *
	 * @dataProvider dataBasicTypes
	 */
	public function testForwardCompatibility($value): void
	{
		Assert::same($value, Php::decode(Php::encode($value)));
	}

	/**
	 * @return array<array<string, mixed>>
	 */
	public function dataBasicTypes(): array
	{
		return testValues();
	}

}

(new PhpTest())->run();
