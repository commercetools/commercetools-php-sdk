<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link http://docs.commercetools.com/http-api-projects-carts.html#change-tax-calculationmode
 * @method string getAction()
 * @method CartChangeTaxCalculationModeAction setAction(string $action = null)
 * @method string getTaxCalculationMode()
 * @method CartChangeTaxCalculationModeAction setTaxCalculationMode(string $taxCalculationMode = null)
 */
class CartChangeTaxCalculationModeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxCalculationMode' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTaxCalculationMode');
    }

    /**
     * @param string $calculationMode
     * @param Context|callable $context
     * @return CartChangeTaxCalculationModeAction
     */
    public static function ofTaxCalculationMode($calculationMode, $context = null)
    {
        return static::of($context)->setTaxCalculationMode($calculationMode);
    }
}
