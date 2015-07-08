<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\CartDiscount\CartDiscountReference;
use Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class DiscountCodeChangeCartDiscountsAction
 * @package Sphere\Core\Request\DiscountCodes\Command
 *  *
 * @method string getAction()
 * @method DiscountCodeChangeCartDiscountsAction setAction(string $action = null)
 * @method CartDiscountReferenceCollection getCartDiscounts()
 * @codingStandardsIgnoreStart
 * @method DiscountCodeChangeCartDiscountsAction setCartDiscounts(CartDiscountReferenceCollection $cartDiscounts = null)
 * @codingStandardsIgnoreEnd
 */
class DiscountCodeChangeCartDiscountsAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'cartDiscounts' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeCartDiscounts');
    }

    /**
     * @param CartDiscountReferenceCollection $referenceCollection
     * @param Context|callable $context
     * @return DiscountCodeChangeCartDiscountsAction
     */
    public static function ofCartDiscountReferences(
        CartDiscountReferenceCollection $referenceCollection,
        $context = null
    ) {
        return static::of($context)->setCartDiscounts($referenceCollection);
    }

    /**
     * @param CartDiscountReference $reference
     * @param Context|callable $context
     * @return DiscountCodeChangeCartDiscountsAction
     */
    public static function ofCartDiscountReference(CartDiscountReference $reference, $context = null)
    {
        return static::ofCartDiscountReferences(CartDiscountReferenceCollection::of($context)->add($reference));
    }
}
