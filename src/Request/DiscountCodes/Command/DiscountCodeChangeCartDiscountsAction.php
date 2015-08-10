<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\CartDiscount\CartDiscountReference;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
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
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'cartDiscounts' => [
                static::TYPE => '\Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection'
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
