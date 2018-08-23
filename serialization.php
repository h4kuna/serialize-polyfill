<?php

define('IGBINARY_READY', extension_loaded('igbinary'));

function serialization($value)
{
	return IGBINARY_READY ? igbinary_serialize($value) : serialize($value);
}


function deserialization($value)
{
	return IGBINARY_READY ? igbinary_unserialize($value) : unserialize($value);
}
