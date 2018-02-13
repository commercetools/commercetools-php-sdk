<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#revert-staged-variant-changes
 * @method string getAction()
 * @method ProductRevertStagedVariantChangesAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductRevertStagedVariantChangesAction setVariantId(int $variantId = null)
 */
class ProductRevertStagedVariantChangesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('revertStagedVariantChanges');
    }

    /**
     * @param $variantId
     * @param Context|callable $context
     * @return ProductRevertStagedVariantChangesAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setVariantId($variantId);
    }
}
