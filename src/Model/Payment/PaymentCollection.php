<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-payments.html#payment
 * @method PaymentCollection add(Payment $element)
 * @method Payment current()
 * @method Payment getAt($offset)
 */
class PaymentCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Payment\Payment';
}
