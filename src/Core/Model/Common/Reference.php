<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\CartDiscount\CartDiscountReference;
use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomObject\CustomObjectReference;
use Commercetools\Core\Model\DiscountCode\DiscountCodeReference;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\Payment\PaymentReference;
use Commercetools\Core\Model\Product\ProductReference;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountReference;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\Zone\ZoneReference;

/**
 * @package Commercetools\Core\Model\Common
 * @ramlTestIgnoreFields('obj')
 * @link https://docs.commercetools.com/http-api-types.html#reference
 * @method string getTypeId()
 * @method string getId()
 * @method Reference setTypeId(string $typeId = null)
 * @method Reference setId(string $id = null)
 * @method JsonObject getObj()
 * @method Reference setObj(JsonObject $obj = null)
 * @method string getKey()
 * @method Reference setKey(string $key = null)
 */
class Reference extends ResourceIdentifier
{
    const OBJ = 'obj';

    const TYPE_CLASS = JsonObject::class;

    public function fieldDefinitions()
    {
        $fieldDefinitions = parent::fieldDefinitions();
        $fieldDefinitions[static::OBJ] = [static::TYPE => static::TYPE_CLASS];

        return $fieldDefinitions;
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == Reference::class && isset($data[static::TYPE_ID])) {
            $className = static::referenceType($data[static::TYPE_ID]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function referenceType($typeId)
    {
        $types = [
            CartReference::TYPE_CART => CartReference::class,
            CartDiscountReference::TYPE_CART_DISCOUNT => CartDiscountReference::class,
            CategoryReference::TYPE_CATEGORY => CategoryReference::class,
            ChannelReference::TYPE_CHANNEL => ChannelReference::class,
            CustomerReference::TYPE_CUSTOMER => CustomerReference::class,
            CustomObjectReference::TYPE_CUSTOM_OBJECT => CustomObjectReference::class,
            CustomerGroupReference::TYPE_CUSTOMER_GROUP =>
                CustomerGroupReference::class,
            DiscountCodeReference::TYPE_DISCOUNT_CODE => DiscountCodeReference::class,
            CustomObjectReference::TYPE_CUSTOM_OBJECT => CustomObjectReference::class,
            PaymentReference::TYPE_PAYMENT => PaymentReference::class,
            ProductReference::TYPE_PRODUCT => ProductReference::class,
            ProductDiscountReference::TYPE_PRODUCT_DISCOUNT =>
                ProductDiscountReference::class,
            ProductTypeReference::TYPE_PRODUCT_TYPE => ProductTypeReference::class,
            OrderReference::TYPE_ORDER => OrderReference::class,
            ShippingMethodReference::TYPE_SHIPPING_METHOD =>
                ShippingMethodReference::class,
            StateReference::TYPE_STATE => StateReference::class,
            TaxCategoryReference::TYPE_TAX_CATEGORY => TaxCategoryReference::class,
            TypeReference::TYPE_TYPE => TypeReference::class,
            ZoneReference::TYPE_ZONE => ZoneReference::class,
        ];
        return isset($types[$typeId]) ? $types[$typeId] : Reference::class;
    }
}
