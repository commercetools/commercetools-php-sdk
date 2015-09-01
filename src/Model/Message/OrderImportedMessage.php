<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Order;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method OrderImportedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderImportedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderImportedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderImportedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderImportedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderImportedMessage setType(string $type = null)
 * @method Order getOrder()
 * @method OrderImportedMessage setOrder(Order $order = null)
 */
class OrderImportedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderImported';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['order'] = [static::TYPE => '\Commercetools\Core\Model\Order\Order'];

        return $definitions;
    }
}
