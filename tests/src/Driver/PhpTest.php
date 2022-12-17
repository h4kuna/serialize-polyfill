<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests\Driver;

use h4kuna\Serialize\Driver;
use Tester\Assert;
use Tester\TestCase;

define('SERIALIZATION_FORCE_DISABLE', true);

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class PhpTest extends TestCase
{

	/**
	 * @throws \h4kuna\Serialize\Exception\InvalidStateException
	 */
	public function testBackCompatibility(): void
	{
		$value = 'foo';
		$data = Driver\IgBinary::encode($value);
		Assert::same($value, Driver\Php::decode($data));
	}


	/**
	 * @param mixed $value
	 * @dataProvider dataBasicTypes
	 */
	public function testForwardCompatibility($value): void
	{
		Assert::same($value, Driver\Php::decode(Driver\Php::encode($value)));
	}


	/**
	 * @return array<array<string, mixed>>
	 */
	public function dataBasicTypes(): array
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

(new PhpTest())->run();
