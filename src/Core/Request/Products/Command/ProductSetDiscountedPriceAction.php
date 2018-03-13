<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DiscountedPrice;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-discounted-price
 * @method string getAction()
 * @method ProductSetDiscountedPriceAction setAction(string $action = null)
 * @method string getPriceId()
 * @method ProductSetDiscountedPriceAction setPriceId(string $priceId = null)
 * @method bool getStaged()
 * @method ProductSetDiscountedPriceAction setStaged(bool $staged = null)
 * @method DiscountedPrice getDiscounted()
 * @method ProductSetDiscountedPriceAction setDiscounted(DiscountedPrice $discounted = null)
 */
class ProductSetDiscountedPriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
            'discounted' => [static::TYPE => DiscountedPrice::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDiscountedPrice');
    }

    /**
     * @param string $priceId
     * @param Context|callable $context
     * @return ProductSetDiscountedPriceAction
     */
    public static function ofPriceId($priceId, $context = null)
    {
        return static::of($context)->setPriceId($priceId);
    }
}
