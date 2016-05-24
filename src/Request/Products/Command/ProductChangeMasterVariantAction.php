<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link http://dev.commercetools.com/http-api-projects-products.html#change-master-variant
 * @method string getAction()
 * @method ProductChangeMasterVariantAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductChangeMasterVariantAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductChangeMasterVariantAction setSku(string $sku = null)
 * @method bool getStaged()
 * @method ProductChangeMasterVariantAction setStaged(bool $staged = null)
 */
class ProductChangeMasterVariantAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
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
        $this->setAction('changeMasterVariant');
    }

    /**
     * @param $variantId
     * @return ProductChangeMasterVariantAction
     */
    public static function ofVariantId($variantId)
    {
        return static::of()->setVariantId($variantId);
    }

    /**
     * @param $sku
     * @return ProductChangeMasterVariantAction
     */
    public static function ofSku($sku)
    {
        return static::of()->setSku($sku);
    }
}
