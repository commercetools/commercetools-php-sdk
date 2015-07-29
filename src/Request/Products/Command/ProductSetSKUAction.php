<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#set-sku
 * @method string getAction()
 * @method ProductSetSKUAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetSKUAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetSKUAction setSku(string $sku = null)
 */
class ProductSetSKUAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setSKU');
    }

    /**
     * @param int $variantId
     * @param Context|callable $context
     * @return ProductSetSKUAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setVariantId($variantId);
    }
}
