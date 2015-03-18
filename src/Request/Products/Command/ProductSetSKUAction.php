<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetSKUAction
 * @package Sphere\Core\Request\Products\Command
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
     * @param int $variantId
     */
    public function __construct($variantId)
    {
        $this->setAction('setSKU');
        $this->setVariantId($variantId);
    }
}
