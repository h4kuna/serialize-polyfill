<?php

/**
 * @return bool
 */
function serializationCheckIgbinary($value) {
	static $haystack = ["\x00\x00\x00\x01", "\x00\x00\x00\x02"];

	return in_array(mb_substr($value, 0, 4), $haystack, true);
}


/**
 * @return bool
 */
function checkIgbinaryExtension() {
	return (bool) extension_loaded('igbinary');
}

if (!checkIgbinaryExtension() || (defined('SERIALIZATION_FORCE_DISABLE') && SERIALIZATION_FORCE_DISABLE)) {
	require_once __DIR__ . '/src/serialize.php';
} else {
	require_once __DIR__ . '/src/igbinary.php';
}
