<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\PriceDraftCollection;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-prices
 * @method string getAction()
 * @method ProductSetPricesAction setAction(string $action = null)
 * @method PriceDraftCollection getPrices()
 * @method ProductSetPricesAction setPrices(PriceDraftCollection $prices = null)
 * @method bool getStaged()
 * @method ProductSetPricesAction setStaged(bool $staged = null)
 * @method int getVariantId()
 * @method ProductSetPricesAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetPricesAction setSku(string $sku = null)
 */
class ProductSetPricesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => PriceDraftCollection::class],
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
        $this->setAction('setPrices');
    }

    /**
     * @param $variantId
     * @param PriceDraftCollection $prices
     * @param Context|callable $context
     * @return ProductSetPricesAction
     */
    public static function ofVariantIdAndPrices($variantId, PriceDraftCollection $prices, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setPrices($prices);
    }

    /**
     * @param $sku
     * @param PriceDraftCollection $prices
     * @param Context|callable $context
     * @return ProductSetPricesAction
     */
    public static function ofSkuAndPrices($sku, PriceDraftCollection $prices, $context = null)
    {
        return static::of($context)->setSku($sku)->setPrices($prices);
    }
}
