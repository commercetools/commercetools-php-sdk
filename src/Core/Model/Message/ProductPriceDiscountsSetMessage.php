<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types.html#productpricediscountsset-message
 * @method string getId()
 * @method ProductPriceDiscountsSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductPriceDiscountsSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductPriceDiscountsSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductPriceDiscountsSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductPriceDiscountsSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductPriceDiscountsSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductPriceDiscountsSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductPriceDiscountsSetMessage setType(string $type = null)
 * @method ProductPriceDiscountsSetUpdatedPriceCollection getUpdatedPrices()
 * phpcs:disable
 * @method ProductPriceDiscountsSetMessage setUpdatedPrices(ProductPriceDiscountsSetUpdatedPriceCollection $updatedPrices = null)
 * phpcs:enable
 */
class ProductPriceDiscountsSetMessage extends Message
{
    const MESSAGE_TYPE = 'ProductPriceDiscountsSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['updatedPrices'] = [static::TYPE => ProductPriceDiscountsSetUpdatedPriceCollection::class];

        return $definitions;
    }
}
