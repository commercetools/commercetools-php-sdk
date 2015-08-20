<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 *  *
 * @method string getAction()
 * @method CartDiscountSetValidUntilAction setAction(string $action = null)
 * @method DateTimeDecorator getValidUntil()
 * @method CartDiscountSetValidUntilAction setValidUntil(\DateTime $validUntil = null)
 */
class CartDiscountSetValidUntilAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'validUntil' => [
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
        $this->setAction('setValidUntil');
    }
}
