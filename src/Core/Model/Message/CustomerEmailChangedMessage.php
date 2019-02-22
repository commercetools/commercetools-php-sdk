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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customeremailchanged-message
 * @method string getId()
 * @method CustomerEmailChangedMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerEmailChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerEmailChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerEmailChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerEmailChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerEmailChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerEmailChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerEmailChangedMessage setType(string $type = null)
 * @method string getEmail()
 * @method CustomerEmailChangedMessage setEmail(string $email = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerEmailChangedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class CustomerEmailChangedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerEmailChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['email'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
