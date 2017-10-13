<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Payment\Transaction;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#paymentstatusinterfacecodeset-message
 * @method string getId()
 * @method PaymentStatusInterfaceCodeSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method PaymentStatusInterfaceCodeSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentStatusInterfaceCodeSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentStatusInterfaceCodeSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method PaymentStatusInterfaceCodeSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentStatusInterfaceCodeSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentStatusInterfaceCodeSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentStatusInterfaceCodeSetMessage setType(string $type = null)
 * @method string getInterfaceCode()
 * @method PaymentStatusInterfaceCodeSetMessage setInterfaceCode(string $interfaceCode = null)
 */
class PaymentStatusInterfaceCodeSetMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentStatusInterfaceCodeSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['paymentId'] = [static::TYPE => 'string'];
        $definitions['interfaceCode'] = [static::TYPE => 'string'];

        return $definitions;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getPaymentId()
    {
        return parent::getPaymentId();
    }

    /**
     * @deprecated
     * @param string $paymentId
     * @return static
     */
    public function setPaymentId($paymentId = null)
    {
        return parent::setPaymentId($paymentId);
    }
}
