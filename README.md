# Serialization

[![Downloads this Month](https://img.shields.io/packagist/dm/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)
[![Latest stable](https://img.shields.io/packagist/v/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)

In your project are available two new methods.

 - h4kuna\Serialize\Serialize::encode()
 - h4kuna\Serialize\Serialize::decode()

If you enable igbinary extension, then automatic use Driver\IgBinary. Or you can define own implmentation by Driver interface. 

## Example why use Serialize class
In many use cases is igbinary faster. Anybody use in third party library h4kuna\Serialize\Serialize::encode/decode. If you enable igbinary and for this third party case you want to disable and to use standard serialization. See example. 

External library in vendor
```php
namespace Com\Example;

use h4kuna\Serialize\Serialize;

class Foo implements \Serializable {
    public function serialize(): ?string {
        return Serialize::encode($this, __CLASS__);
    }

    public function unserialize(string $data): void {
        Serialize::decode($data, __CLASS__);
        // do anything
    }
}
```

Enable standard serialization for class above.

```php
use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Serialize;

require_once __DIR__ . '/vendor/autoload.php';
Serialize::setUp(Driver\IgBinary::class, [
    Com\Example\Foo::class => Driver\Php::class // only for Com\Example\Foo use case
]); 
```

## Compatibility

You are using php serialize and you want to use igbinary. You can enable igbinaty on fly and old serialized data will be decoded by old php serialize.

> Support compatibility, if you have serialized data by php serialize, then you can decode by IgBinary::decode() and vice versa.

## Enable igbinary

1. Install igbinary extension
2. 
```php
require __DIR__ . '/vendor/autoload.php';
\h4kuna\Serialize\Serialize::setUp(IgBinary::class);
```

Works!

## Disable igbinary

1. set Php driver after vendor/autoload.php 
```php
require __DIR__ . '/vendor/autoload.php';
// \h4kuna\Serialize\Serialize::setUp(IgBinary::class); remove
```
2. wait if your all data will be decoded
3. uninstall igbinary extension
