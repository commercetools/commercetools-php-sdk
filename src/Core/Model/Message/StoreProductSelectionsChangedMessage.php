<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Model\Common\LocalizedString;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/api/message-types#storeproductselectionschangedmessage
 * @method string getId()
 * @method StoreProductSelectionsChangedMessage setId(string $id = null)
 * @method int getVersion()
 * @method StoreProductSelectionsChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method StoreProductSelectionsChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method StoreProductSelectionsChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method StoreProductSelectionsChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method StoreProductSelectionsChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method StoreProductSelectionsChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method StoreProductSelectionsChangedMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method StoreProductSelectionsChangedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method array getAddedProductSelections()
 * @method StoreProductSelectionsChangedMessage setAddedProductSelections(array $addedProductSelections = null)
 * @method array getRemovedProductSelections()
 * @method StoreProductSelectionsChangedMessage setRemovedProductSelections(array $removedProductSelections = null)
 * @method array getUpdatedProductSelections()
 * @method StoreProductSelectionsChangedMessage setUpdatedProductSelections(array $updatedProductSelections = null)
 */
class StoreProductSelectionsChangedMessage extends Message
{
    const MESSAGE_TYPE = 'StoreProductSelectionsChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['addedProductSelections'] = [static::TYPE => 'array'];
        $definitions['removedProductSelections'] = [static::TYPE => 'array'];
        $definitions['updatedProductSelections'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
