<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#set-valid-from
 * @method string getAction()
 * @method CartDiscountSetValidFromAction setAction(string $action = null)
 * @method DateTimeDecorator getValidFrom()
 * @method CartDiscountSetValidFromAction setValidFrom(\DateTime $validFrom = null)
 */
class CartDiscountSetValidFromAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'validFrom' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setValidFrom');
    }
}
