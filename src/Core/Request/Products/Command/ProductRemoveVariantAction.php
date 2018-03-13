<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#remove-productvariant
 * @method string getAction()
 * @method ProductRemoveVariantAction setAction(string $action = null)
 * @method int getId()
 * @method ProductRemoveVariantAction setId(int $id = null)
 * @method string getSku()
 * @method ProductRemoveVariantAction setSku(string $sku = null)
 * @method bool getStaged()
 * @method ProductRemoveVariantAction setStaged(bool $staged = null)
 */
class ProductRemoveVariantAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'id' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
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
        $this->setAction('removeVariant');
    }

    /**
     * @param int $variantId
     * @param Context|callable $context
     * @return ProductRemoveVariantAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setId($variantId);
    }

    /**
     * @param string $sku
     * @param Context|callable $context
     * @return ProductRemoveVariantAction
     */
    public static function ofSku($sku, $context = null)
    {
        return static::of($context)->setSku($sku);
    }
}
