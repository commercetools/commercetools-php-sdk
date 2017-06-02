<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#remove-price
 * @method string getAction()
 * @method ProductRemovePriceAction setAction(string $action = null)
 * @method Price getPrice()
 * @method ProductRemovePriceAction setPrice(Price $price = null)
 * @method bool getStaged()
 * @method ProductRemovePriceAction setStaged(bool $staged = null)
 * @method string getPriceId()
 * @method ProductRemovePriceAction setPriceId(string $priceId = null)
 */
class ProductRemovePriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'string'],
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
        $this->setAction('removePrice');
    }

    /**
     * @param string $priceId
     * @param Context|callable $context
     * @return ProductRemovePriceAction
     */
    public static function ofPriceId($priceId, $context = null)
    {
        return static::of($context)->setPriceId($priceId);
    }
}
