<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Price;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductChangePriceAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductChangePriceAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductChangePriceAction setVariantId(int $variantId = null)
 * @method Price getPrice()
 * @method ProductChangePriceAction setPrice(Price $price = null)
 * @method bool getStaged()
 * @method ProductChangePriceAction setStaged(bool $staged = null)
 */
class ProductChangePriceAction extends AbstractAction
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
        $this->setAction('changePrice');
        $this->setVariantId($variantId);
        $this->setPrice($price);
    }
}
