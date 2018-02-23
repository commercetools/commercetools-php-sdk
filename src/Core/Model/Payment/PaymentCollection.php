<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://docs.commercetools.com/http-api-projects-payments.html#payment
 * @method PaymentCollection add(Payment $element)
 * @method Payment current()
 * @method Payment getAt($offset)
 * @method Payment getById($offset)
 */
class PaymentCollection extends Collection
{
    protected $type = Payment::class;
}
