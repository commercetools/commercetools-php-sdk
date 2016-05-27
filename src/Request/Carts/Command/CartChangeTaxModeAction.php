<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link http://dev.commercetools.com/http-api-projects-carts.html#change-taxmode
 * @method string getAction()
 * @method CartChangeTaxModeAction setAction(string $action = null)
 * @method string getTaxMode()
 * @method CartChangeTaxModeAction setTaxMode(string $taxMode = null)
 */
class CartChangeTaxModeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxMode' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTaxMode');
    }
}
