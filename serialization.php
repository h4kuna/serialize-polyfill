<?php

define('IGBINARY_READY', extension_loaded('igbinary'));

function serialization($value)
{
	return IGBINARY_READY ? igbinary_serialize($value) : serialize($value);
}


function deserialization($value)
{
	if (IGBINARY_READY) {
		$data = @igbinary_unserialize($value);
		if ($data === null) {
			$error = error_get_last();
			static $haystack = ["\x00\x00\x00\x01", "\x00\x00\x00\x02"];
			if ($error === null || in_array(mb_substr($value, 0, 4), $haystack)) {
				return $data;
			} // else unserialize forward compatibility
			error_clear_last();
		} else {
			return $data;
		}
	}
	return unserialize($value);
}
