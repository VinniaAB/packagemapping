<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 2016-05-19
 * Time: 16:50
 */

namespace Vinnia\PackageMapping;


class SearchParameter implements \JsonSerializable
{

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $carrierCode;

    /**
     * SearchParameter constructor.
     * @param string $trackingNumber
     * @param string $carrierCode
     */
    function __construct($trackingNumber, $carrierCode = '')
    {
        $this->trackingNumber = $trackingNumber;
        $this->carrierCode = $carrierCode;
    }

    /**
     * @inheritdoc
     */
    function jsonSerialize()
    {
        return [
            'TrackingNumber' => $this->trackingNumber,
            'CarrierCode' => $this->carrierCode,
        ];
    }
}
