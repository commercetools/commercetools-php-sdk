<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Price;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductAddPriceAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductAddPriceAction setAction(string $action)
 * @method int getVariantId()
 * @method ProductAddPriceAction setVariantId(int $variantId)
 * @method Price getPrice()
 * @method ProductAddPriceAction setPrice(Price $price)
 * @method bool getStaged()
 * @method ProductAddPriceAction setStaged(bool $staged)
 */
class ProductAddPriceAction extends AbstractAction
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
        $this->setAction('addPrice');
        $this->setVariantId($variantId);
        $this->setPrice($price);
    }
}
