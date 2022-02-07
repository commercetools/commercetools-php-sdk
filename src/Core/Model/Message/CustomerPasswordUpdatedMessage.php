<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/api/message-types#customerpasswordupdatedmessage
 * @method string getId()
 * @method CustomerPasswordUpdatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerPasswordUpdatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerPasswordUpdatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerPasswordUpdatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerPasswordUpdatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerPasswordUpdatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerPasswordUpdatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerPasswordUpdatedMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerPasswordUpdatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method bool getReset()
 * @method CustomerPasswordUpdatedMessage setReset(bool $reset = null)
 */
class CustomerPasswordUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerPasswordUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['reset'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
