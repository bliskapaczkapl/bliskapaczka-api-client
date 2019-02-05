<?php

namespace Bliskapaczka\ApiClient\Bliskapaczka;

use Bliskapaczka\ApiClient\Config;
use Bliskapaczka\ApiClient\Bliskapaczka\Todoor;
use PHPUnit\Framework\TestCase;

class TodoorTest extends TestCase
{
    protected function setUp()
    {
        $this->todoorData = [
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
            "receiverStreet" => "Testowa",
            "receiverBuildingNumber" => "1",
            "receiverFlatNumber" => '11',
            "receiverPostCode" => "12-345",
            "receiverCity" => "Testowe",
            "deliveryType" => "D2D",
            "operatorName" => "DPD",
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
        $this->assertTrue(class_exists('Bliskapaczka\ApiClient\Bliskapaczka\Todoor'));
    }

    public function testGetUrl()
    {
        $apiUrl = 'http://localhost:1234';
        
        $apiClientTodoor = new Todoor($this->configMock);
        $apiClientTodoor->setApiUrl($apiUrl);

        $this->assertEquals('order', $apiClientTodoor->getUrl());
    }

    public function testCreate()
    {
        $apiUrl = 'http://localhost:1234';
        
        $apiClientTodoor = new Todoor($this->configMock);
        $apiClientTodoor->setApiUrl($apiUrl);

        $apiClientTodoor->create($this->todoorData);
    }

    public function testGetValidator()
    {
        $apiUrl = 'http://localhost:1234';
        
        $apiClientTodoor = new Todoor($this->configMock);
        $apiClientTodoor->setApiUrl($apiUrl);

        $this->assertTrue(is_a($apiClientTodoor->getValidator(), 'Bliskapaczka\ApiClient\Validator\Todoor'));
    }
}
