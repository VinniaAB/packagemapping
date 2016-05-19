# Wrapper for the PackageMapping API
For more information regarding the api, see https://commercial.packagemapping.com/documentation#document-5

## Dependencies
- php 5.5+
- composer

## Installation

## Usage
```php
use Vinnia\PackageMapping\Client;

$client = Client::make('my-packagemapping-key');

$carriersResponse = $client->getCarrierCodeList([
    Client::CARRIER_UPS,
    Client::CARRIER_USPS,
]);

$data = json_decode((string) $carriersResponse->getBody(), $assoc = true);
var_dump($data);

$trackingsResponse = $client->getTrackList([
    [
        'TrackingNumber' => 'some-tracking-number',
    ],
]);

$data = json_decode((string) $trackingsResponse->getBody(), $assoc = true);
var_dump($data);

```

## Testing
