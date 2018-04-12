<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customerdateofbirthset-message
 * @method string getId()
 * @method CustomerDateOfBirthSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerDateOfBirthSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerDateOfBirthSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerDateOfBirthSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerDateOfBirthSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerDateOfBirthSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerDateOfBirthSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerDateOfBirthSetMessage setType(string $type = null)
 * @method DateDecorator getDateOfBirth()
 * @method CustomerDateOfBirthSetMessage setDateOfBirth(DateTime $dateOfBirth = null)
 */
class CustomerDateOfBirthSetMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerDateOfBirthSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['dateOfBirth'] = [static::TYPE => DateTime::class, static::DECORATOR => DateDecorator::class];

        return $definitions;
    }
}
