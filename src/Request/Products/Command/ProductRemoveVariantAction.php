<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductRemoveVariantAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#remove-variant
 * @method string getAction()
 * @method ProductRemoveVariantAction setAction(string $action = null)
 * @method int getId()
 * @method ProductRemoveVariantAction setId(int $id = null)
 * @method bool getStaged()
 * @method ProductRemoveVariantAction setStaged(bool $staged = null)
 */
class ProductRemoveVariantAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'id' => [static::TYPE => 'int'],
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
     * @return ProductRemovePriceAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setId($variantId);
    }
}
