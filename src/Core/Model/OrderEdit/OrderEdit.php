<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Order\OrderReference;
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
 * @method array getStagedActions()
 * @method OrderEdit setStagedActions(array $stagedActions = null)
 * @method CustomFieldObject getCustom()
 * @method OrderEdit setCustom(CustomFieldObject $custom = null)
 * @method OrderEditResult getResult()
 * @method OrderEdit setResult(OrderEditResult $result = null)
 * @method string getComment()
 * @method OrderEdit setComment(string $comment = null)
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
            'key' => [static::TYPE => 'string'],
            'resource' => [static::TYPE => OrderReference::class],
            'stagedActions' => [static::TYPE => 'array'],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'result' => [static::TYPE => OrderEditResult::class],
            'comment' => [static::TYPE => 'string']
        ];
    }
}
