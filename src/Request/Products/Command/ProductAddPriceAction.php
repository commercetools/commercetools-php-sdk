<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#add-price
 * @method string getAction()
 * @method ProductAddPriceAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductAddPriceAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductAddPriceAction setSku(string $sku = null)
 * @method PriceDraft getPrice()
 * @method ProductAddPriceAction setPrice(PriceDraft $price = null)
 * @method bool getStaged()
 * @method ProductAddPriceAction setStaged(bool $staged = null)
 */
class ProductAddPriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'price' => [static::TYPE => '\Commercetools\Core\Model\Common\PriceDraft'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addPrice');
    }

    /**
     * @param int $variantId
     * @param PriceDraft $price
     * @param Context|callable $context
     * @return ProductAddPriceAction
     */
    public static function ofVariantIdAndPrice($variantId, PriceDraft $price, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setPrice($price);
    }

    /**
     * @param string $sku
     * @param PriceDraft $price
     * @param Context|callable $context
     * @return ProductAddPriceAction
     */
    public static function ofSkuAndPrice($sku, PriceDraft $price, $context = null)
    {
        return static::of($context)->setSku($sku)->setPrice($price);
    }
}
