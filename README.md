# Serialization

[![Downloads this Month](https://img.shields.io/packagist/dm/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)
[![Latest stable](https://img.shields.io/packagist/v/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)

In your project are available two new methods.

 - serialization()
 - deserialization()

If you enable igbinary, then use igbinary_(un)serialize otherwise (un)serialize.

It is support forward compatibility, if you cache data by old function **serialize()** and these data will be in cache and enable igbinary than function deserialization has mechanism use function **unserialize()**. 
