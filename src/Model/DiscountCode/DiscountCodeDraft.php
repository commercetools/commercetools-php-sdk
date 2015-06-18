<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\DiscountCode;

use Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class DiscountCodeDraft
 * @package Sphere\Core\Model\DiscountCode
 * @method LocalizedString getName()
 * @method DiscountCodeDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method DiscountCodeDraft setDescription(LocalizedString $description = null)
 * @method string getCode()
 * @method DiscountCodeDraft setCode(string $code = null)
 * @method CartDiscountReferenceCollection getCartDiscounts()
 * @method DiscountCodeDraft setCartDiscounts(CartDiscountReferenceCollection $cartDiscounts = null)
 * @method string getCartPredicate()
 * @method DiscountCodeDraft setCartPredicate(string $cartPredicate = null)
 * @method bool getIsActive()
 * @method DiscountCodeDraft setIsActive(bool $isActive = null)
 * @method int getMaxApplications()
 * @method DiscountCodeDraft setMaxApplications(int $maxApplications = null)
 * @method int getMaxApplicationsPerCustomer()
 * @method DiscountCodeDraft setMaxApplicationsPerCustomer(int $maxApplicationsPerCustomer = null)
 * @method static DiscountCodeDraft of($code, CartDiscountReferenceCollection $cartDiscounts, $isActive)
 */
class DiscountCodeDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection'],
            'cartPredicate' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'maxApplications' => [static::TYPE => 'int'],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param string $code
     * @param CartDiscountReferenceCollection $cartDiscounts
     * @param bool $isActive
     * @param Context|callable $context
     */
    public function __construct($code, CartDiscountReferenceCollection $cartDiscounts, $isActive, $context = null)
    {
        $this->setContext($context)->setCode($code)->setCartDiscounts($cartDiscounts)->setIsActive($isActive);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            $data['code'],
            CartDiscountReferenceCollection::fromArray($data['cartDiscounts'], $context),
            $data['isActive'],
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
