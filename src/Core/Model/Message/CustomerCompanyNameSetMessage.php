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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customercompanynameset-message
 * @method string getId()
 * @method CustomerCompanyNameSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerCompanyNameSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerCompanyNameSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerCompanyNameSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerCompanyNameSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerCompanyNameSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerCompanyNameSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerCompanyNameSetMessage setType(string $type = null)
 * @method string getCompanyName()
 * @method CustomerCompanyNameSetMessage setCompanyName(string $companyName = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method CustomerCompanyNameSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class CustomerCompanyNameSetMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerCompanyNameSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['companyName'] = [static::TYPE => 'string', static::OPTIONAL => true];

        return $definitions;
    }
}
