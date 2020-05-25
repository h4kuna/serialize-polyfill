<?php

function serialization($value)
{
	return igbinary_serialize($value);
}


function deserialization($value)
{
	$data = @igbinary_unserialize($value);
	if ($data === null) {
		$error = error_get_last();
		if ($error === null || serializationCheckIgbinary($value)) {
			return $data;
		} // else unserialize forward compatibility
		error_clear_last();

		return unserialize($value);
	}

	return $data;
}
