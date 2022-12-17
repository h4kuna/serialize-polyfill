<?php

use h4kuna\Serialize;

if (!extension_loaded('igbinary') || (defined('SERIALIZATION_FORCE_DISABLE') && SERIALIZATION_FORCE_DISABLE)) {
	Serialize\Serialize::setUp(new Serialize\Driver\Php());
} else {
	Serialize\Serialize::setUp(new Serialize\Driver\IgBinary());
}
