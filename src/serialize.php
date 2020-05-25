<?php

use h4kuna\SerializePolyfill;

function serialization($value)
{
	return serialize($value);
}

function deserialization($value)
{
	$data = @unserialize($value);
	if ($data === false) {
		$error = error_get_last();
		if ($error === null || !serializationCheckIgbinary($value)) {
			return $data;
		} // else igbinary_unserialize forward compatibility
		error_clear_last();

		if (!checkIgbinaryExtension()) {
			throw new SerializePolyfill\InvalidStateException('You try unserialize data, whose looks like serialize by igbinary, but igbinary is not available. Enable igbinary and set constant SERIALIZATION_FORCE_DISABLE by true. This setting probably help you.');
		}
		return igbinary_unserialize($value);
	}

	return $data;
}
