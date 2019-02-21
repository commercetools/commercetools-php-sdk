<?php
/**
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method MatchingPriceNotFoundError setCode(string $code = null)
 * @method string getMessage()
 * @method MatchingPriceNotFoundError setMessage(string $message = null)
 * @method string getProductId()
 * @method MatchingPriceNotFoundError setProductId(string $productId = null)
 * @method string getVariantId()
 * @method MatchingPriceNotFoundError setVariantId(string $variantId = null)
 * @method string getCurrency()
 * @method MatchingPriceNotFoundError setCurrency(string $currency = null)
 * @method string getCountry()
 * @method MatchingPriceNotFoundError setCountry(string $country = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method MatchingPriceNotFoundError setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method ChannelReference getChannel()
 * @method MatchingPriceNotFoundError setChannel(ChannelReference $channel = null)
 */
class MatchingPriceNotFoundError extends ApiError
{
    const CODE = 'MatchingPriceNotFound';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['productId'] = [static::TYPE => 'string'];
        $definitions['variantId'] = [static::TYPE => 'string'];
        $definitions['currency'] = [static::TYPE => 'string'];
        $definitions['country'] = [static::TYPE => 'string'];
        $definitions['customerGroup'] = [static::TYPE => CustomerGroupReference::class];
        $definitions['channel'] = [static::TYPE => ChannelReference::class];

        return $definitions;
    }
}
