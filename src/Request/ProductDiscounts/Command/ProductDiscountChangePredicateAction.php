<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ProductDiscounts\Command
 *  *
 * @method string getAction()
 * @method ProductDiscountChangePredicateAction setAction(string $action = null)
 * @method string getPredicate()
 * @method ProductDiscountChangePredicateAction setPredicate(string $predicate = null)
 */
class ProductDiscountChangePredicateAction extends AbstractAction
{
    public function getFields()
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
