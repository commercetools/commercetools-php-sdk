<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method StoreCreatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method StoreCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method StoreCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method StoreCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method StoreCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method StoreCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method StoreCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method StoreCreatedMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method StoreCreatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method string getName()
 * @method StoreCreatedMessage setName(string $name = null)
 * @method array getLanguages()
 * @method StoreCreatedMessage setLanguages(array $languages = null)
 * @method array getDistributionChannels()
 * @method StoreCreatedMessage setDistributionChannels(array $distributionChannels = null)
 * @method array getSupplyChannels()
 * @method StoreCreatedMessage setSupplyChannels(array $supplyChannels = null)
 * @method CustomFieldObject getCustom()
 * @method StoreCreatedMessage setCustom(CustomFieldObject $custom = null)
 * @method array getProductSelections()
 * @method StoreCreatedMessage setProductSelections(array $productSelections = null)
 */
class StoreCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'StoreCreated';

    public function fieldDefinitions()
    {
        return array_merge(
            parent::fieldDefinitions(),
            [
                'name' => [static::TYPE => 'string', static::OPTIONAL => true],
                'languages' => [static::TYPE => 'array'],
                'distributionChannels' => [static::TYPE => 'array'],
                'supplyChannels' => [static::TYPE => 'array'],
                'productSelections' => [static::TYPE => 'array'],
                'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            ]
        );
    }
}
