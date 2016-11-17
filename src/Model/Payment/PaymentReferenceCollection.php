<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-payments.html#payment
 * @method PaymentReferenceCollection add(PaymentReference $element)
 * @method PaymentReference current()
 * @method PaymentReference getAt($offset)
 * @method PaymentReference getById($offset)
 */
class PaymentReferenceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Payment\PaymentReference';
}
