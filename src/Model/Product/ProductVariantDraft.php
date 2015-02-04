<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:41
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Type\Attribute;
use Sphere\Core\Model\Type\JsonObject;
use Sphere\Core\Model\Type\Price;

/**
 * Class ProductVariantDraft
 * @package Sphere\Core\Model\Product
 * @method static ProductVariantDraft of()
 */
class ProductVariantDraft extends JsonObject
{
    /**
     * @var string
     */
    protected $sku;

    /**
     * @var Price[]
     */
    protected $prices;

    /**
     * @var Attribute[]
     */
    protected $attributes;

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return Price[]
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param Price[] $prices
     * @return $this
     */
    public function setPrices(array $prices)
    {
        $this->prices = $prices;

        return $this;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param Attribute[] $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
