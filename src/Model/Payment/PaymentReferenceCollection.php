<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method PaymentReferenceCollection add(PaymentReference $element)
 * @method PaymentReference current()
 * @method PaymentReference getAt($offset)
 */
class PaymentReferenceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Payment\PaymentReference';
}
