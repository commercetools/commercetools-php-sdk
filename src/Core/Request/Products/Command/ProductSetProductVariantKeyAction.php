<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#set-productvariant-key
 * @method string getAction()
 * @method ProductSetProductVariantKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method ProductSetProductVariantKeyAction setKey(string $key = null)
 * @method int getVariantId()
 * @method ProductSetProductVariantKeyAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetProductVariantKeyAction setSku(string $sku = null)
 * @method bool getStaged()
 * @method ProductSetProductVariantKeyAction setStaged(bool $staged = null)
 */
class ProductSetProductVariantKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setProductVariantKey');
    }

    /**
     * @param $variantId
     * @param string $key
     * @param Context|callable $context
     * @return ProductSetProductVariantKeyAction
     */
    public static function ofVariantIdAndKey($variantId, $key, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setKey($key);
    }

    /**
     * @param $sku
     * @param string $key
     * @param Context|callable $context
     * @return ProductSetProductVariantKeyAction
     */
    public static function ofSkuAndKey($sku, $key, $context = null)
    {
        return static::of($context)->setSku($sku)->setKey($key);
    }
}
