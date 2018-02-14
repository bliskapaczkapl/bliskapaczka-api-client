<?php

namespace Bliskapaczka\ApiClient\Bliskapaczka\Order;

use Bliskapaczka\ApiClient\AbstractBliskapaczka;
use Bliskapaczka\ApiClient\Exception;

/**
 * Bliskapaczka class
 *
 * @author  Mateusz Koszutowski (mkoszutowski@divante.pl)
 * @version 0.1.0
 */
class Waybill extends AbstractBliskapaczka
{
    const REQUEST_URL = 'order/[[id]]/waybill';

    private $orderId = null;

    /**
     * Set order id
     *
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Return valid URL for API call get waybill for order
     *
     * @return string
     */
    public function getUrl()
    {
        if (!isset($this->orderId) || empty($this->orderId)) {
            throw new  Exception('Please set valid order ID', 1);
        }

        return str_replace('[[id]]', $this->orderId, self::REQUEST_URL);
    }

    /**
     * Call API method create order
     *
     * @param array $data
     */
    public function get()
    {
        $response = $this->doCall($this->getUrl(), json_encode(''), array(), 'GET');

        return $response;
    }
}
