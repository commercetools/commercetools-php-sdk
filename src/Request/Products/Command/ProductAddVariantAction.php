<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\AttributeCollection;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\PriceCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductAddVariantAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductAddVariantAction setAction(string $action = null)
 * @method string getSku()
 * @method ProductAddVariantAction setSku(string $sku = null)
 * @method PriceCollection getPrices()
 * @method ProductAddVariantAction setPrices(PriceCollection $prices = null)
 * @method AttributeCollection getAttributes()
 * @method ProductAddVariantAction setAttributes(AttributeCollection $attributes = null)
 * @method bool getStaged()
 * @method ProductAddVariantAction setStaged(bool $staged = null)
 */
class ProductAddVariantAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => '\Sphere\Core\Model\Common\PriceCollection'],
            'attributes' => [static::TYPE => '\Sphere\Core\Model\Common\AttributeCollection'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setAction('addVariant');
    }
}
