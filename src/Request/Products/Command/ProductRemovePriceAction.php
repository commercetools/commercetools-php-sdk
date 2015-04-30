<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Price;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductRemovePriceAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#remove-price
 * @method string getAction()
 * @method ProductRemovePriceAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductRemovePriceAction setVariantId(int $variantId = null)
 * @method Price getPrice()
 * @method ProductRemovePriceAction setPrice(Price $price = null)
 * @method bool getStaged()
 * @method ProductRemovePriceAction setStaged(bool $staged = null)
 */
class ProductRemovePriceAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'price' => [static::TYPE => '\Sphere\Core\Model\Common\Price'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param int $variantId
     * @param Price $price
     */
    public function __construct($variantId, Price $price)
    {
        $this->setAction('removePrice');
        $this->setVariantId($variantId);
        $this->setPrice($price);
    }
}
