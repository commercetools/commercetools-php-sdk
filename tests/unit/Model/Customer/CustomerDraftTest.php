<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

class CustomerDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            CustomerDraft::class,
            CustomerDraft::fromArray(
                [
                    'email' => 'john.doe@company.com',
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'password' => 'secret',
                ]
            )
        );
    }
}
