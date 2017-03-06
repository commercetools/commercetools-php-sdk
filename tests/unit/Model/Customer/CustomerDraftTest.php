<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

class CustomerDraftTest extends \PHPUnit\Framework\TestCase
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

    public function testDateOfBirth()
    {
        $draft = CustomerDraft::of();
        $draft->setDateOfBirth(new \DateTime('2015-10-15 10:00'));
        $this->assertJsonStringEqualsJsonString('{"dateOfBirth": "2015-10-15"}', json_encode($draft));

    }
}
