<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests;

use h4kuna\Serialize\Driver\IgBinary;
use h4kuna\Serialize\Serialize;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';
Serialize::setUp(IgBinary::class);

$data = Serialize::encode('foo');
Assert::same('foo', IgBinary::decode($data));
