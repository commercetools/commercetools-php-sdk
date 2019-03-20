<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customeremailverified-message
 * @method string getId()
 * @method CustomerEmailVerifiedMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerEmailVerifiedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerEmailVerifiedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerEmailVerifiedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerEmailVerifiedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerEmailVerifiedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerEmailVerifiedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerEmailVerifiedMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerEmailVerifiedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class CustomerEmailVerifiedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerEmailVerified';
}
