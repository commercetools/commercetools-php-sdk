<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#set-attribute
 * @method string getAction()
 * @method ProductSetAttributeAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetAttributeAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetAttributeAction setSku(string $sku = null)
 * @method string getName()
 * @method ProductSetAttributeAction setName(string $name = null)
 * @method getValue()
 * @method ProductSetAttributeAction setValue($value = null)
 * @method bool getStaged()
 * @method ProductSetAttributeAction setStaged(bool $staged = null)
 */
class ProductSetAttributeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
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
        $this->setAction('setAttribute');
    }

    /**
     * @param int $variantId
     * @param string $name
     * @param Context|callable $context
     * @return ProductSetAttributeAction
     */
    public static function ofVariantIdAndName($variantId, $name, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setName($name);
    }

    /**
     * @param string $sku
     * @param string $name
     * @param Context|callable $context
     * @return ProductSetAttributeAction
     */
    public static function ofSkuAndName($sku, $name, $context = null)
    {
        return static::of($context)->setSku($sku)->setName($name);
    }
}
