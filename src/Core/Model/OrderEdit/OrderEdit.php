<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method string getId()
 * @method OrderEdit setId(string $id = null)
 * @method int getVersion()
 * @method OrderEdit setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderEdit setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderEdit setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getKey()
 * @method OrderEdit setKey(string $key = null)
 * @method OrderReference getResource()
 * @method OrderEdit setResource(OrderReference $resource = null)
 * @method StagedOrderUpdateActionCollection getStagedActions()
 * @method OrderEdit setStagedActions(StagedOrderUpdateActionCollection $stagedActions = null)
 * @method CustomFieldObject getCustom()
 * @method OrderEdit setCustom(CustomFieldObject $custom = null)
 * @method OrderEditResult getResult()
 * @method OrderEdit setResult(OrderEditResult $result = null)
 * @method string getComment()
 * @method OrderEdit setComment(string $comment = null)
 * @method CreatedBy getCreatedBy()
 * @method OrderEdit setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method OrderEdit setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method OrderEditReference getReference()
 */
class OrderEdit extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'resource' => [static::TYPE => OrderReference::class],
            'stagedActions' => [static::TYPE => StagedOrderUpdateActionCollection::class],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'result' => [static::TYPE => OrderEditResult::class],
            'comment' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
