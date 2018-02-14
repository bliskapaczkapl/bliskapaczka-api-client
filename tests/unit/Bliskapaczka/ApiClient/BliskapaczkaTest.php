<?php

namespace Bliskapaczka;

use PHPUnit\Framework\TestCase;

class BliskapaczkaTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Bliskapaczka\ApiClient\AbstractBliskapaczka'));
        $this->assertTrue(class_exists('Bliskapaczka\ApiClient\Bliskapaczka\Order'));
    }

    public function testGetApiUrlForMode()
    {
        $apiKey = '6061914b-47d3-42de-96bf-0004a57f1dba';
        $apiClient = new \Bliskapaczka\ApiClient\Bliskapaczka\Order($apiKey);

        $url = $apiClient->getApiUrlForMode('prod');
        $this->assertEquals('https://api.bliskapaczka.pl', $url);

        $url = $apiClient->getApiUrlForMode('test');
        $this->assertEquals('https://api.sandbox-bliskapaczka.pl', $url);
    }

    public function testSetApiUrl()
    {
        $apiKey = '6061914b-47d3-42de-96bf-0004a57f1dba';
        $apiUrl = 'http://localhost:1234';
        $apiClient = new \Bliskapaczka\ApiClient\Bliskapaczka\Order($apiKey);
        $apiClient->setApiUrl($apiUrl);

        $this->assertEquals($apiUrl, $apiClient->getApiUrl());
    }
}
