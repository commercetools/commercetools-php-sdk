<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\DiscountedPrice;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types.html#productpriceexternaldiscountset-message
 * @method string getId()
 * @method ProductPriceExternalDiscountSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductPriceExternalDiscountSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductPriceExternalDiscountSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductPriceExternalDiscountSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductPriceExternalDiscountSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductPriceExternalDiscountSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductPriceExternalDiscountSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductPriceExternalDiscountSetMessage setType(string $type = null)
 * @method ProductPriceDiscountsSetUpdatedPriceCollection getUpdatedPrices()
 * phpcs:disable
 * @method ProductPriceDiscountsSetMessage setUpdatedPrices(ProductPriceDiscountsSetUpdatedPriceCollection $updatedPrices = null)
 * phpcs:enable
 * @method int getVariantId()
 * @method ProductPriceExternalDiscountSetMessage setVariantId(int $variantId = null)
 * @method string getVariantKey()
 * @method ProductPriceExternalDiscountSetMessage setVariantKey(string $variantKey = null)
 * @method string getSku()
 * @method ProductPriceExternalDiscountSetMessage setSku(string $sku = null)
 * @method string getPriceId()
 * @method ProductPriceExternalDiscountSetMessage setPriceId(string $priceId = null)
 * @method DiscountedPrice getDiscounted()
 * @method ProductPriceExternalDiscountSetMessage setDiscounted(DiscountedPrice $discounted = null)
 * @method bool getStaged()
 * @method ProductPriceExternalDiscountSetMessage setStaged(bool $staged = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductPriceExternalDiscountSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ProductPriceExternalDiscountSetMessage extends Message
{
    const MESSAGE_TYPE = 'ProductPriceExternalDiscountSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['variantId'] = [static::TYPE => 'int'];
        $definitions['variantKey'] = [static::TYPE => 'string'];
        $definitions['sku'] = [static::TYPE => 'string'];
        $definitions['priceId'] = [static::TYPE => 'string'];
        $definitions['discounted'] = [static::TYPE => DiscountedPrice::class];
        $definitions['staged'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
