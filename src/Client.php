<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 2016-05-19
 * Time: 15:00
 */

namespace Vinnia\PackageMapping;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;

class Client
{

    const API_URL = 'https://ws.packagemapping.com/Services/PackageMapping/ITrackService/rest/json';
    const CONTENT_TYPE_JSON = 'application/json; charset=utf-8';

    const CARRIER_UPS = 'ups';
    const CARRIER_USPS = 'usps';
    const CARRIER_FEDEX = 'fedex';
    const CARRIER_DHL = 'dhl';
    const CARRIER_DHL_GLOBAL_MAIL = 'dhlglobalmail';
    const CARRIER_CANADA_POST = 'canadapost';
    const CARRIER_FDM = 'fdm';
    const CARRIER_LANDMARK_GLOBAL = 'landmarkglobal';
    const CARRIER_LASERSHIP = 'lasership';
    const CARRIER_LONE_STAR_OVERNIGHT = 'lso';
    const CARRIER_ONTRAC = 'ontrac';
    const CARRIER_PUROLATOR = 'purolator';
    const CARRIER_PUROPOST = 'puropost';
    const CARRIER_RRD_INTL = 'rrdintl';
    const CARRIER_SINGAPORE_POST = 'singpost';
    const CARRIER_SPEE_DEE = 'speedee';
    const CARRIER_UPS_MI = 'upsmi';

    /**
     * @var GuzzleClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $webServiceKey;

    /**
     * Client constructor.
     * @param GuzzleClientInterface $client
     * @param $webServiceKey
     */
    function __construct(GuzzleClientInterface $client, $webServiceKey)
    {
        $this->client = $client;
        $this->webServiceKey = $webServiceKey;
    }

    /**
     * @param string $webServiceKey
     * @return Client
     */
    public static function make($webServiceKey)
    {
        $guzzle = new \GuzzleHttp\Client();
        return new self($guzzle, $webServiceKey);
    }

    /**
     * See https://ws.packagemapping.com/Services/PackageMapping/ITrackService/rest/json/help/operations/GetCarrierCodeList
     *
     * @param string $trackingNumber
     * @param array $allowedCarriers
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCarrierCodeList($trackingNumber = '', array $allowedCarriers = [])
    {
        return $this->client->request('POST', self::API_URL . '/GetCarrierCodeList', [
            'headers' => [
                'Accept' => self::CONTENT_TYPE_JSON,
                'Content-Type' => self::CONTENT_TYPE_JSON,
            ],
            'json' => [
                'TrackingNumber' => $trackingNumber,
                'AllowedCarrierCodes' => $allowedCarriers,
                'WebServiceKey' => $this->webServiceKey,
            ],
        ]);
    }

    /**
     * See https://ws.packagemapping.com/Services/PackageMapping/ITrackService/rest/json/help/operations/GetTrackList
     *
     * @param array $searchParameters
     * @param array $allowedCarriers
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTrackList(array $searchParameters, array $allowedCarriers = [])
    {
        return $this->client->request('POST', self::API_URL . '/GetCarrierCodeList', [
            'headers' => [
                'Accept' => self::CONTENT_TYPE_JSON,
                'Content-Type' => self::CONTENT_TYPE_JSON,
            ],
            'json' => [
                'SearchParameters' => $searchParameters,
                'AllowedCarrierCodes' => $allowedCarriers,
                'WebServiceKey' => $this->webServiceKey,
            ],
        ]);
    }

}
