<?php

namespace Bliskapaczka\ApiClient\Validator;

use Bliskapaczka\ApiClient\ValidatorInterface;
use Bliskapaczka\ApiClient\Validator\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    protected function setUp()
    {
        $this->orderData = [
            "senderFirstName" => "string",
            "senderLastName" => "string",
            "senderPhoneNumber" => "111111111",
            "senderEmail" => "bob@example.com",
            "senderStreet" => "string",
            "senderBuildingNumber" => "string",
            "senderFlatNumber" => "string",
            "senderPostCode" => "54-130",
            "senderCity" => "string",
            "receiverFirstName" => "string",
            "receiverLastName" => "string",
            "receiverPhoneNumber" => "111111111",
            "receiverEmail" => "eva@example.com",
            "deliveryType" => "P2P",
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
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('Bliskapaczka\ApiClient\Validator\Order'));
    }

    public function testClassImplementInterface()
    {
        $order = new Order();
        $this->assertTrue(is_a($order, 'Bliskapaczka\ApiClient\ValidatorInterface'));
    }

    public function testReceiverPhoneNumberStringShorterThan30CharsValidation()
    {
        $this->orderData['receiverPhoneNumber'] = 'some_string';

        $order = new Order();
        $order->setData($this->orderData);
        $this->assertTrue($order->validate());
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessage Invalid receiverPhoneNumber
     */
    public function testReceiverPhoneNumberLongerThan30CharsValidation()
    {
        $this->orderData['receiverPhoneNumber'] = 'more_than_30_chars_111111111111';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessage Invalid post code
     */
    public function testSenderPostCodeValidation()
    {
        $this->orderData['senderPostCode'] = 'string';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessage Invalid parcel
     */
    public function testParcelsValidation()
    {
        $this->orderData['parcel'] = 'string';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessageRegExp /Invalid \w+/
     */
    public function testReceiverFirstNameValidation()
    {
        $this->orderData['receiverFirstName'] = '';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessageRegExp /Invalid \w+/
     */
    public function testReceiverFirstNameValidationForNameLongerThanThirtyCharacters()
    {
        $this->orderData['receiverFirstName'] = 'NameLongerThanThirtyCharacterss';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessageRegExp /Invalid \w+/
     */
    public function testReceiverLastNameValidation()
    {
        $this->orderData['receiverLastName'] = '';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessageRegExp /Invalid \w+/
     */
    public function testOperatorNameValidation()
    {
        $this->orderData['operatorName'] = '';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessageRegExp /Invalid \w+/
     */
    public function testDestinationCodeValidation()
    {
        $this->orderData['destinationCode'] = '';

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessage Dimesnion must be greater than 0
     */
    public function testParcelDimensionsValidation()
    {
        $this->orderData['parcel']['dimensions']['height'] = 0;

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();

        $this->orderData['parcel']['dimensions']['height'] = -1;

        $order = new Order();
        $order->setData($this->orderData);
        $order->validate();
    }

    /**
     * @expectedException Bliskapaczka\ApiClient\Exception
     * @expectedExceptionMessage Invalid deliveryType
     */
    public function testDeliveryTypeValidation()
    {
        $this->todoorData['deliveryType'] = '';

        $todoor = new Todoor();
        $todoor->setData($this->todoorData);
        $todoor->validate();
    }
}
