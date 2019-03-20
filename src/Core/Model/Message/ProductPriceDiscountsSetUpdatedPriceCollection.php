<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types.html#productpricediscountsset-message
 * @method ProductPriceDiscountsSetUpdatedPrice current()
 * @method ProductPriceDiscountsSetUpdatedPriceCollection add(ProductPriceDiscountsSetUpdatedPrice $element)
 * @method ProductPriceDiscountsSetUpdatedPrice getAt($offset)
 */
class ProductPriceDiscountsSetUpdatedPriceCollection extends Collection
{
    protected $type = ProductPriceDiscountsSetUpdatedPrice::class;
}
