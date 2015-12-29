<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

class CustomerTest extends \PHPUnit_Framework_TestCase
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
}
