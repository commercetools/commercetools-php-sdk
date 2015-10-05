<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Payment\Payment;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method PaymentCreatedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentCreatedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method PaymentCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentCreatedMessage setType(string $type = null)
 * @method Payment getPayment()
 * @method PaymentCreatedMessage setPayment(Payment $payment = null)
 */
class PaymentCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['payment'] = [static::TYPE => '\Commercetools\Core\Model\Payment\Payment'];

        return $definitions;
    }
}
