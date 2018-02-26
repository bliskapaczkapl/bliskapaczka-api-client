<?php

namespace Bliskapaczka\ApiClient\Validator\Order;

use Bliskapaczka\ApiClient\ValidatorInterface;
use Bliskapaczka\ApiClient\Validator\Order\Advice;
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
        ];
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('Bliskapaczka\ApiClient\Validator\Order\Advice'));
    }

    public function testClassImplementInterface()
    {
        $advice = new Advice();
        $this->assertTrue(is_a($advice, 'Bliskapaczka\ApiClient\ValidatorInterface'));
    }

    public function testExtendsOrder()
    {
        $advice = new Advice();
        $this->assertTrue(is_a($advice, 'Bliskapaczka\ApiClient\Validator\Order'));
    }
}
