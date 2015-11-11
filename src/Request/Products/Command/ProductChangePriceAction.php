<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#change-price
 * @method string getAction()
 * @method ProductChangePriceAction setAction(string $action = null)
 * @method PriceDraft getPrice()
 * @method ProductChangePriceAction setPrice(PriceDraft $price = null)
 * @method bool getStaged()
 * @method ProductChangePriceAction setStaged(bool $staged = null)
 * @method string getPriceId()
 * @method ProductChangePriceAction setPriceId(string $priceId = null)
 */
class ProductChangePriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'string'],
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
        $this->setAction('changePrice');
    }

    /**
     * @param string $priceId
     * @param PriceDraft $price
     * @param Context|callable $context
     * @return ProductChangePriceAction
     */
    public static function ofPriceIdAndPrice($priceId, PriceDraft $price, $context = null)
    {
        return static::of($context)->setPriceId($priceId)->setPrice($price);
    }
}
