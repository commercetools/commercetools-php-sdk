<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link http://dev.commercetools.com/http-api-projects-products.html#remove-variant
 * @method string getAction()
 * @method ProductRemoveVariantAction setAction(string $action = null)
 * @method int getId()
 * @method ProductRemoveVariantAction setId(int $id = null)
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
