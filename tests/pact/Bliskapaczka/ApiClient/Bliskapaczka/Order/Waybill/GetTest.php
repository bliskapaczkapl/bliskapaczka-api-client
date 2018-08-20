<?php

namespace  Bliskapaczka\ApiClient\Bliskapaczka\Order\Waybill;

use Bliskapaczka\ApiClient\Config;
use Bliskapaczka\ApiClient\Mappers\Pricing;
use PHPUnit\Framework\TestCase;

class GetTest extends TestCase
{
    protected function setUp()
    {
        if (getenv('PACT_MOCK_SERVICE_URL')) {
            $this->host = 'madkom__pact-mock-service:1234';
        } else {
            $this->host = 'localhost:1234';
        }

        $this->orderId = '000000001P-000000002';

        $this->deleteInteractions();
        $this->setInteraction();

        $apiKey = 'test-test-test-test';
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

    public function testGetWaybill()
    {
        $apiClient = new \Bliskapaczka\ApiClient\Bliskapaczka\Order\Waybill($this->configMock);
        $apiClient->setApiUrl($this->host);
        $apiClient->setOrderId($this->orderId);

        $response = json_decode($apiClient->get());

        $this->assertEquals('https://storage.googleapis.com/000000001P-000000002.pdf', $response->url);
    }

    /**
     * Delete interactions
     */
    protected function deleteInteractions()
    {
        $curl = curl_init();

        // build Authorization header
        $headers[] = 'X-Pact-Mock-Service: true';
        
        // set options
        $options[CURLOPT_URL] = $this->host . '/interactions';
        $options[CURLOPT_TIMEOUT] = 60;
        $options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $options[CURLOPT_HTTPHEADER] = $headers;

        $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';

        curl_setopt_array($curl, $options);
        curl_exec($curl);
    }

    protected function setInteraction()
    {
        $curl = curl_init();

        // build Authorization header
        $headers[] = 'X-Pact-Mock-Service: true';
        $headers[] = 'Content-Type: application/json';
        
        // set options
        $options[CURLOPT_URL] = $this->host . '/interactions';
        $options[CURLOPT_TIMEOUT] = 60;
        $options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $options[CURLOPT_HTTPHEADER] = $headers;

        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = '{
  "description": "Get waybill URL for order",
  "provider_state": "API should return URL",
  "request": {
    "method": "get",
    "path": "/v1/order/' . $this->orderId . '/waybill"
  },
  "response": {
    "status": 200,
    "headers": {
      "Content-Type": "application/json"
    },
    "body": {
      "url" : "https://storage.googleapis.com/000000001P-000000002.pdf"
    }
  }
}';

        curl_setopt_array($curl, $options);
        curl_exec($curl);
    }

    /**
     * Delete interactions
     */
    protected function verification()
    {
        $curl = curl_init();

        // build Authorization header
        $headers[] = 'X-Pact-Mock-Service: true';
        
        // set options
        $options[CURLOPT_URL] = $this->host . '/interactions/verification';
        $options[CURLOPT_TIMEOUT] = 60;
        $options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $options[CURLOPT_HTTPHEADER] = $headers;

        curl_setopt_array($curl, $options);
        curl_exec($curl);
    }
}
