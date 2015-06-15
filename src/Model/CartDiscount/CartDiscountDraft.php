<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * Class CartDiscountDraft
 * @package Sphere\Core\Model\CartDiscount
 * @method LocalizedString getName()
 * @method CartDiscountDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method CartDiscountDraft setDescription(LocalizedString $description = null)
 * @method CartDiscountValue getValue()
 * @method CartDiscountDraft setValue(CartDiscountValue $value = null)
 * @method string getCartPredicate()
 * @method CartDiscountDraft setCartPredicate(string $cartPredicate = null)
 * @method CartDiscountTarget getTarget()
 * @method CartDiscountDraft setTarget(CartDiscountTarget $target = null)
 * @method string getSortOrder()
 * @method CartDiscountDraft setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method CartDiscountDraft setIsActive(bool $isActive = null)
 * @method DateTimeDecorator getValidFrom()
 * @method CartDiscountDraft setValidFrom(\DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method CartDiscountDraft setValidUntil(\DateTime $validUntil = null)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscountDraft setRequiresDiscountCode(bool $requiresDiscountCode = null)
 * @codingStandardsIgnoreStart
 * @method static CartDiscountDraft of(LocalizedString $name, CartDiscountValue $value, $cartPredicate, CartDiscountTarget $target, $sortOrder, $isActive, $requiresDiscountCode)
 * @codingStandardsIgnoreEnd
 */
class CartDiscountDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'value' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountValue'],
            'cartPredicate' => [static::TYPE => 'string'],
            'target' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountTarget'],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'validFrom' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
            'validUntil' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
            'requiresDiscountCode' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param CartDiscountValue $value
     * @param $cartPredicate
     * @param CartDiscountTarget $target
     * @param $sortOrder
     * @param $isActive
     * @param $requiresDiscountCode
     * @param Context|callable $context
     */
    public function __construct(
        LocalizedString $name,
        CartDiscountValue $value,
        $cartPredicate,
        CartDiscountTarget $target,
        $sortOrder,
        $isActive,
        $requiresDiscountCode,
        $context = null
    ) {
        $this->setContext($context)
            ->setName($name)
            ->setValue($value)
            ->setCartPredicate($cartPredicate)
            ->setTarget($target)
            ->setSortOrder($sortOrder)
            ->setIsActive($isActive)
            ->setRequiresDiscountCode($requiresDiscountCode)
        ;
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            LocalizedString::fromArray($data['name']),
            CartDiscountValue::fromArray($data['value']),
            $data['cartPredicate'],
            CartDiscountTarget::fromArray($data['target']),
            $data['sortOrder'],
            $data['isActive'],
            $data['requiresDiscountCode']
        );
        $draft->setRawData($data);

        return $draft;
    }
}
