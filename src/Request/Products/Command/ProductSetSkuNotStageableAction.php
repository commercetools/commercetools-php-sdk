<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @deprecated use ProductSetSkuAction instead
 * @link https://dev.commercetools.com/http-api-projects-products.html#set-sku
 * @method string getAction()
 * @method ProductSetSkuNotStageableAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetSkuNotStageableAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetSkuNotStageableAction setSku(string $sku = null)
 */
class ProductSetSkuNotStageableAction extends AbstractAction
{
    public function fieldDefinitions()
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
     * @return ProductSetSkuNotStageableAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setVariantId($variantId);
    }
}
