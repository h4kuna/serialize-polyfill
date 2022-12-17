<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests\Driver;

use h4kuna\Serialize\Driver\IgBinary;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class IgBinaryTest extends TestCase
{
	/**
	 * @throws \h4kuna\Serialize\Exception\InvalidStateException
	 */
	public function testFailed(): void
	{
		$value = 'foo';
		$data = serialize($value);
		Assert::same($value, IgBinary::decode($data));
	}


	/**
	 * @param mixed $value
	 * @dataProvider dataBasicTypes
	 */
	public function testForwardCompatibility($value): void
	{
		Assert::same($value, IgBinary::decode(IgBinary::encode($value)));
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

(new IgBinaryTest())->run();
