<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-sku
 * @method string getAction()
 * @method ProductSetSkuAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetSkuAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetSkuAction setSku(string $sku = null)
 * @method bool getStaged()
 * @method ProductSetSkuAction setStaged(bool $staged = null)
 */
class ProductSetSkuAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
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
        $this->setAction('setSku');
    }

    /**
     * @param int $variantId
     * @param Context|callable $context
     * @return ProductSetSkuAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setVariantId($variantId);
    }
}
