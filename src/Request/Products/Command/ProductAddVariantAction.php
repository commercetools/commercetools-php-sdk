<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link http://dev.commercetools.com/http-api-projects-products.html#add-variant
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
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => '\Commercetools\Core\Model\Common\PriceCollection'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'],
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
        $this->setAction('addVariant');
    }
}
