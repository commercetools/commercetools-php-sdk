<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductDiscount;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class ProductDiscountDraft
 * @package Sphere\Core\Model\ProductDiscount
 * @method LocalizedString getName()
 * @method ProductDiscountDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductDiscountDraft setDescription(LocalizedString $description = null)
 * @method ProductDiscountValue getValue()
 * @method ProductDiscountDraft setValue(ProductDiscountValue $value = null)
 * @method string getPredicate()
 * @method ProductDiscountDraft setPredicate(string $predicate = null)
 * @method string getSortOrder()
 * @method ProductDiscountDraft setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method ProductDiscountDraft setIsActive(bool $isActive = null)
 */
class ProductDiscountDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'value' => [static::TYPE => '\Sphere\Core\Model\ProductDiscount\ProductDiscountValue'],
            'predicate' => [static::TYPE => 'string'],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param ProductDiscountValue $value
     * @param string $predicate
     * @param string $sortOrder
     * @param bool $isActive
     * @param Context|callable $context
     */
    public function __construct(
        LocalizedString $name,
        ProductDiscountValue $value,
        $predicate,
        $sortOrder,
        $isActive,
        $context = null
    ) {
        $this->setContext($context)
            ->setName($name)
            ->setValue($value)
            ->setPredicate($predicate)
            ->setSortOrder($sortOrder)
            ->setIsActive($isActive)
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
            LocalizedString::fromArray($data['name'], $context),
            ProductDiscountValue::fromArray($data['value'], $context),
            $data['predicate'],
            $data['sortOrder'],
            $data['isActive'],
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
