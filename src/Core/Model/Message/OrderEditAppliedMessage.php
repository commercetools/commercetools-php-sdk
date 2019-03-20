<?php
/**
 *
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\OrderEdit\OrderEditApplied;
use Commercetools\Core\Model\OrderEdit\OrderEditReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method OrderEditAppliedMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderEditAppliedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderEditAppliedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderEditAppliedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderEditAppliedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderEditAppliedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderEditAppliedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderEditAppliedMessage setType(string $type = null)
 * @method OrderEditReference getEdit()
 * @method OrderEditAppliedMessage setEdit(OrderEditReference $edit = null)
 * @method OrderEditApplied getResult()
 * @method OrderEditAppliedMessage setResult(OrderEditApplied $result = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderEditAppliedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class OrderEditAppliedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderEditApplied';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['edit'] = [static::TYPE => OrderEditReference::class];
        $definitions['result'] = [static::TYPE => OrderEditApplied::class];

        return $definitions;
    }
}
