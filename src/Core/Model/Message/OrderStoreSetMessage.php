<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types.html#orderstoreset
 * @method string getId()
 * @method OrderStoreSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderStoreSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderStoreSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderStoreSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderStoreSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderStoreSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderStoreSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderStoreSetMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderStoreSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method StoreReference getStore()
 * @method OrderStoreSetMessage setStore(StoreReference $store = null)
 */
class OrderStoreSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderStoreSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['store'] = [static::TYPE => StoreReference::class];

        return $definitions;
    }
}
