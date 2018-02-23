<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-predicate
 * @method string getAction()
 * @method ProductDiscountChangePredicateAction setAction(string $action = null)
 * @method string getPredicate()
 * @method ProductDiscountChangePredicateAction setPredicate(string $predicate = null)
 */
class ProductDiscountChangePredicateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changePredicate');
    }

    /**
     * @param string $predicate
     * @param Context|callable $context
     * @return ProductDiscountChangePredicateAction
     */
    public static function ofPredicate($predicate, $context = null)
    {
        return static::of($context)->setPredicate($predicate);
    }
}
