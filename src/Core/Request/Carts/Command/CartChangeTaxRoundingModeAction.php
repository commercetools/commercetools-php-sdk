<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link http://dev.commercetools.com/http-api-projects-carts.html#change-tax-roundingmode
 * @method string getAction()
 * @method CartChangeTaxRoundingModeAction setAction(string $action = null)
 * @method string getTaxRoundingMode()
 * @method CartChangeTaxRoundingModeAction setTaxRoundingMode(string $taxRoundingMode = null)
 */
class CartChangeTaxRoundingModeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxRoundingMode' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTaxRoundingMode');
    }

    /**
     * @param string $roundingMode
     * @param Context|callable $context
     * @return CartChangeLineItemQuantityAction
     */
    public static function ofTaxRoundingMode($roundingMode, $context = null)
    {
        return static::of($context)->setTaxRoundingMode($roundingMode);
    }
}
