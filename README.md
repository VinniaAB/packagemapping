# Wrapper for the PackageMapping API
For more information regarding the api, see https://commercial.packagemapping.com/documentation#document-5

## Dependencies
- php 5.5+
- composer

## Installation
Add a repository to your composer.json like so:
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/VinniaAB/packagemapping.git"
    }
  ]
}
```

And then require the package with composer:
```shell
composer require vinnia/packagemapping
```

## Usage
A complete html example is located in `example.php`.

```php
use Vinnia\PackageMapping\Client;
use Vinnia\PackageMapping\Carrier;
use Vinnia\PackageMapping\SearchParameter;

$client = Client::make('my-packagemapping-key');

$carriersResponse = $client->getCarrierCodeList([
    Carrier::UPS,
    Carrier::USPS,
]);

$data = json_decode((string) $carriersResponse->getBody(), $assoc = true);
var_dump($data);

$trackingsResponse = $client->getTrackList([
    new SearchParameter('some-tracking-number'),
]);

$data = json_decode((string) $trackingsResponse->getBody(), $assoc = true);
var_dump($data);

```

## Testing
Copy `env.sample.php` into `env.php` and enter your web service key and a valid tracking number. Then run the tests:
```shell
vendor/bin/codecept run
```
