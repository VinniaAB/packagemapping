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
     * @param string[] $allowedCarriers
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCarrierCodeList($trackingNumber, array $allowedCarriers = [])
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
     * @param SearchParameter[] $searchParameters
     * @param string[] $allowedCarriers
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTrackList(array $searchParameters, array $allowedCarriers = [])
    {
        return $this->client->request('POST', self::API_URL . '/GetTrackList', [
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
