<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#add-price
 * @method string getAction()
 * @method ProductAddPriceAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductAddPriceAction setVariantId(int $variantId = null)
 * @method Price getPrice()
 * @method ProductAddPriceAction setPrice(Price $price = null)
 * @method bool getStaged()
 * @method ProductAddPriceAction setStaged(bool $staged = null)
 */
class ProductAddPriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'price' => [static::TYPE => '\Commercetools\Core\Model\Common\Price'],
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
        $this->setAction('addPrice');
    }

    /**
     * @param int $variantId
     * @param Price $price
     * @param Context|callable $context
     * @return ProductAddPriceAction
     */
    public static function ofVariantIdAndPrice($variantId, Price $price, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setPrice($price);
    }
}
