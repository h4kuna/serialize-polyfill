<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests;

use h4kuna\Serialize\Base64;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class Base64Test extends TestCase
{

	/**
	 * @param mixed $value
	 * @dataProvider dataBasicTypes
	 */
	public function testBasic($value): void
	{
		Assert::same($value, Base64::decode(Base64::encode($value)));
	}


	/**
	 * @return array<array<string, mixed>>
	 */
	public function dataBasicTypes(): array
	{
		return testValues();
	}

}

(new Base64Test())->run();
