# Serialization

[![Downloads this Month](https://img.shields.io/packagist/dm/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)
[![Latest stable](https://img.shields.io/packagist/v/h4kuna/serialize-polyfill.svg)](https://packagist.org/packages/h4kuna/serialize-polyfill)

Part of the [h4kuna PHP libraries](https://github.com/h4kuna/library), see the overview of all packages.

Install by composer, requires PHP 8.0 or newer.

```bash
composer require h4kuna/serialize-polyfill
```

Two new methods are available in your project.

 - `h4kuna\Serialize\Serialize::encode()`
 - `h4kuna\Serialize\Serialize::decode()`

By default, native PHP serialization is used (`Driver\Php`). If you have the igbinary extension, you can switch to `Driver\IgBinary` by `Serialize::setUp()`, see [Enable igbinary](#enable-igbinary). Or you can define your own implementation of the `Driver` interface.

The driver can be set up only once and it must be done before the first `encode()` or `decode()` call, otherwise `Driver\Php` is set up automatically and another driver throws `InvalidStateException`.

There is also `h4kuna\Serialize\Base64` with `encode()` and `decode()`, which wraps the serialized string in base64.

## Example why use Serialize class
In many use cases igbinary is faster. Imagine a third party library which uses `h4kuna\Serialize\Serialize::encode()/decode()`. You enable igbinary, but for this third party library you want to keep standard serialization. See the example.

External library in vendor
```php
namespace Com\Example;

use h4kuna\Serialize\Serialize;

class Foo {
    public function save(array $data): string {
        return Serialize::encode($data, __CLASS__);
    }

    public function load(string $data): array {
        return Serialize::decode($data, __CLASS__);
    }
}
```

Enable standard serialization for the class above.

```php
use h4kuna\Serialize\Driver;
use h4kuna\Serialize\Serialize;

require_once __DIR__ . '/vendor/autoload.php';
Serialize::setUp(Driver\IgBinary::class, [
    Com\Example\Foo::class => Driver\Php::class, // only for the Com\Example\Foo use case
]);
```

## Compatibility

You are using PHP serialize and you want to use igbinary. You can enable igbinary on the fly and the old serialized data will be decoded by PHP unserialize.

> If you have data serialized by PHP serialize, you can decode it by `IgBinary::decode()` and vice versa, `Php::decode()` decodes igbinary data if the extension is loaded.

## Enable igbinary

1. Install the igbinary extension.
2. Set up the driver right after `vendor/autoload.php`.

```php
require __DIR__ . '/vendor/autoload.php';
\h4kuna\Serialize\Serialize::setUp(\h4kuna\Serialize\Driver\IgBinary::class);
```

Works!

## Disable igbinary

1. Remove the setup of the IgBinary driver, `Driver\Php` is used by default.
```php
require __DIR__ . '/vendor/autoload.php';
// \h4kuna\Serialize\Serialize::setUp(\h4kuna\Serialize\Driver\IgBinary::class); remove
```
2. Wait until all your igbinary data is decoded or expired.
3. Uninstall the igbinary extension.
