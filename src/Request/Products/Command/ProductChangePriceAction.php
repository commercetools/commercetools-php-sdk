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
 * @link http://dev.sphere.io/http-api-projects-products.html#change-price
 * @method string getAction()
 * @method ProductChangePriceAction setAction(string $action = null)
 * @method Price getPrice()
 * @method ProductChangePriceAction setPrice(Price $price = null)
 * @method bool getStaged()
 * @method ProductChangePriceAction setStaged(bool $staged = null)
 * @method int getPriceId()
 * @method ProductChangePriceAction setPriceId(int $priceId = null)
 */
class ProductChangePriceAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'int'],
            'price' => [static::TYPE => '\Sphere\Core\Model\Common\Price'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param int $priceId
     * @param Price $price
     */
    public function __construct($priceId, Price $price)
    {
        $this->setAction('changePrice');
        $this->setPriceId($priceId);
        $this->setPrice($price);
    }
}
