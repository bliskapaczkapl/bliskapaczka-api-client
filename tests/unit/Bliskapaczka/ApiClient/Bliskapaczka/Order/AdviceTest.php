<?php

namespace Bliskapaczka\ApiClient\Bliskapaczka\Order;

use Bliskapaczka\ApiClient\Config;
use Bliskapaczka\ApiClient\Bliskapaczka\Order\Advice;
use PHPUnit\Framework\TestCase;

class AdviceTest extends TestCase
{
    protected function setUp()
    {
        $this->orderData = [
            "senderFirstName" => "string",
            "senderLastName" => "string",
            "senderPhoneNumber" => "606555433",
            "senderEmail" => "bob@example.com",
            "senderStreet" => "string",
            "senderBuildingNumber" => "string",
            "senderFlatNumber" => "string",
            "senderPostCode" => "54-130",
            "senderCity" => "string",
            "receiverFirstName" => "string",
            "receiverLastName" => "string",
            "receiverPhoneNumber" => "600555432",
            "receiverEmail" => "eva@example.com",
            "operatorName" => "INPOST",
            "destinationCode" => "KRA010",
            "postingCode" => "KRA011",
            "codValue" => 0,
            "insuranceValue" => 0,
            "additionalInformation" => "string",
            "parcel" => [
                "dimensions" => [
                    "height" => 20,
                    "length" => 20,
                    "width" => 20,
                    "weight" => 2
                ]
            ]
        ];

        $apiKey = '6061914b-47d3-42de-96bf-0004a57f1dba';
        $this->configMock = $this->getMockBuilder(Config::class)
                                     ->disableOriginalConstructor()
                                     ->disableOriginalClone()
                                     ->disableArgumentCloning()
                                     ->disallowMockingUnknownTypes()
                                     ->setMethods(
                                         array(
                                             'getApiKey'
                                         )
                                     )
                                     ->getMock();

        $this->configMock->method('getApiKey')->will($this->returnValue($apiKey));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('Bliskapaczka\ApiClient\Bliskapaczka\Order'));
    }

    public function testGetUrl()
    {
        $apiUrl = 'http://localhost:1234';
        
        $apiClientOrder = new Advice($this->configMock);
        $apiClientOrder->setApiUrl($apiUrl);

        $this->assertEquals('order/advice', $apiClientOrder->getUrl());
    }

    public function testCreate()
    {
        $apiKey = '6061914b-47d3-42de-96bf-0004a57f1dba';
        $apiUrl = 'http://localhost:1234';
        
        $apiClientOrder = new Advice($this->configMock);
        $apiClientOrder->setApiUrl($apiUrl);

        $apiClientOrder->create($this->orderData);
    }

    public function testCreateWithoutPostingCode()
    {
        $apiUrl = 'http://localhost:1234';
        
        $apiClientOrder = new Advice($this->configMock);
        $apiClientOrder->setApiUrl($apiUrl);

        unset($this->orderData['postingCode']);

        $apiClientOrder->create($this->orderData);
    }

    public function testGetValidator()
    {
        $apiUrl = 'http://localhost:1234';
        
        $apiClientOrder = new Advice($this->configMock);
        $apiClientOrder->setApiUrl($apiUrl);

        $this->assertTrue(is_a($apiClientOrder->getValidator(), 'Bliskapaczka\ApiClient\Validator\Order'));
    }
}
