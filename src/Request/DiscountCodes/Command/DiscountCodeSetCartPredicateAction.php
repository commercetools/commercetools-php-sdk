<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 *
 * @method string getAction()
 * @method DiscountCodeSetCartPredicateAction setAction(string $action = null)
 * @method string getCartPredicate()
 * @method DiscountCodeSetCartPredicateAction setCartPredicate(string $cartPredicate = null)
 */
class DiscountCodeSetCartPredicateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'cartPredicate' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCartPredicate');
    }
}
