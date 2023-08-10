# Serialization

[![Downloads this Month](https://img.shields.io/packagist/dm/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)
[![Latest stable](https://img.shields.io/packagist/v/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)

In your project are available two new methods.

 - h4kuna\Serialize\Serialize::encode()
 - h4kuna\Serialize\Serialize::decode()

If you enable igbinary extension, then automatic use Driver\IgBinary. Or you can define own implmentation by Driver interface. 


## Compatibility

You are using php serialize and you want to use igbinary. You can enable igbinaty on fly and old serialized data will be decoded by old php serialize.

> Support compatibility, if you have serialized data by php serialize, then you can decode by IgBinary::decode() and vice versa.

## Enable igbinary

1. Install igbinary extension

Works!

## Disable igbinary

1. set constant as first things `define('SERIALIZATION_FORCE_DISABLE', true);` before vendor/autoload.php
2. wait if your all data will be decoded
3. uninstall igbinary extension
4. remove constant `SERIALIZATION_FORCE_DISABLE`
