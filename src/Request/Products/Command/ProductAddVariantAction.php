<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\ImageCollection;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#add-productvariant
 * @method string getAction()
 * @method ProductAddVariantAction setAction(string $action = null)
 * @method string getSku()
 * @method ProductAddVariantAction setSku(string $sku = null)
 * @method PriceDraftCollection getPrices()
 * @method ProductAddVariantAction setPrices(PriceDraftCollection $prices = null)
 * @method AttributeCollection getAttributes()
 * @method ProductAddVariantAction setAttributes(AttributeCollection $attributes = null)
 * @method bool getStaged()
 * @method ProductAddVariantAction setStaged(bool $staged = null)
 * @method string getKey()
 * @method ProductAddVariantAction setKey(string $key = null)
 * @method ImageCollection getImages()
 * @method ProductAddVariantAction setImages(ImageCollection $images = null)
 */
class ProductAddVariantAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => '\Commercetools\Core\Model\Common\PriceDraftCollection'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'],
            'staged' => [static::TYPE => 'bool'],
            'key' => [static::TYPE => 'string'],
            'images' => [static::TYPE => '\Commercetools\Core\Model\Common\ImageCollection']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addVariant');
    }
}
