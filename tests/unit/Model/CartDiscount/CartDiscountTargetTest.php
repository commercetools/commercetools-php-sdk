<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;


class CartDiscountTargetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getTargetsProvider
     */
    public function testFromArray($expectedClass, $type)
    {
        $data = [];
        if (!is_null($type)) {
            $data['type'] = $type;
        }
        $target = CartDiscountTarget::fromArray($data);
        $this->assertInstanceOf($expectedClass, $target);
        $this->assertSame($type, $target->getType());
    }

    /**
     * @dataProvider getTargetsProvider
     */
    public function testOf($class, $type)
    {
        /**
         * @var CartDiscountTarget $target
         */
        $target = $class::of();
        $this->assertSame($type, $target->getType());
    }

    public function getTargetsProvider()
    {
        return [
            CartDiscountTarget::class => [CartDiscountTarget::class, null],
            LineItemsTarget::class => [LineItemsTarget::class, 'lineItems'],
            CustomLineItemsTarget::class => [CustomLineItemsTarget::class, 'customLineItems'],
            ShippingCostTarget::class => [ShippingCostTarget::class, 'shipping'],
            MultiBuyLineItemsTarget::class => [MultiBuyLineItemsTarget::class, 'multiBuyLineItems'],
        ];
    }
}
