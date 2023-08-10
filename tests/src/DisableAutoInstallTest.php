<?php declare(strict_types=1);

namespace h4kuna\Serialize\Tests;

use h4kuna\Serialize\Driver\Php;
use h4kuna\Serialize\Serialize;
use Tester\Assert;

define('SERIALIZATION_FORCE_DISABLE', true);

require_once __DIR__ . '/../bootstrap.php';

$data = Serialize::encode('foo');
Assert::same('foo', Php::decode($data));
