<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

class CustomerTest extends \PHPUnit\Framework\TestCase
{
    public function testSerialize()
    {
        $t = Customer::of()
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setCustomerGroup(
                CustomerGroupReference::ofId('id1')->setObj(CustomerGroup::of()->setName('Test'))
            );
        $t = serialize($t->toArray());
        $customer = Customer::fromArray(unserialize($t));

        $this->assertSame('John', $customer->getFirstName());
        $this->assertSame('Test', $customer->getCustomerGroup()->getObj()->getName());
    }

    protected function getCustomer()
    {
        return Customer::fromArray(
            [
                'addresses' => [
                    [
                        'id' => 'defaultShippingAddress'
                    ],
                    [
                        'id' => 'defaultBillingAddress'
                    ],
                ],
                'defaultShippingAddressId' => 'defaultShippingAddress',
                'defaultBillingAddressId' => 'defaultBillingAddress',
            ]
        );
    }
    public function testGetDefaultShippingAddress()
    {
        $t = $this->getCustomer();
        $this->assertInstanceOf(Address::class, $t->getDefaultShippingAddress());
        $this->assertSame('defaultShippingAddress', $t->getDefaultShippingAddress()->getId());
    }

    public function testGetDefaultBillingAddress()
    {
        $t = $this->getCustomer();
        $this->assertInstanceOf(Address::class, $t->getDefaultBillingAddress());
        $this->assertSame('defaultBillingAddress', $t->getDefaultBillingAddress()->getId());
    }

    public function testGetDefaultShippingAddressForEmptyCustomer()
    {
        $customer = Customer::fromArray([]);
        $this->assertNull($customer->getDefaultShippingAddress());
        $this->assertNull($customer->getDefaultBillingAddress());
    }
}
