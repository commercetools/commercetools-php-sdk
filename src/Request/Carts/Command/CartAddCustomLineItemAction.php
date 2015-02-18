<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\TaxCategory\TaxCategory;
use Sphere\Core\Request\AbstractAction;

class CartAddCustomLineItemAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'quantity' => [static::TYPE => 'int'],
            'money' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'slug' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategory'],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param int $quantity
     * @param Money $money
     * @param string $slug
     * @param TaxCategory $taxCategory
     */
    public function __construct(LocalizedString $name, $quantity, Money $money, $slug, TaxCategory $taxCategory)
    {
        $this->setAction('addCustomLineItem');
        $this->setName($name);
        $this->setQuantity($quantity);
        $this->setMoney($money);
        $this->setSlug($slug);
        $this->setTaxCategory($taxCategory);
    }
}
