<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests;

use h4kuna\Serialize\Driver\IgBinary;
use h4kuna\Serialize\Driver\Php;
use h4kuna\Serialize\Exception\InvalidStateException;
use h4kuna\Serialize\Serialize;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';
Serialize::setUp(Php::class);

$data = Serialize::encode('foo');
Assert::same('foo', Php::decode($data));
Serialize::setUp(Php::class); // does not throw exception
Assert::exception(fn () => Serialize::setUp(IgBinary::class), InvalidStateException::class, 'Driver was already set up "h4kuna\Serialize\Driver\Php" and you want "h4kuna\Serialize\Driver\IgBinary".');
