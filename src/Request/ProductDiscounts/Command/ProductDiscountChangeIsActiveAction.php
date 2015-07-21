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
 * @method ProductDiscountChangeIsActiveAction setAction(string $action = null)
 * @method bool getIsActive()
 * @method ProductDiscountChangeIsActiveAction setIsActive(bool $isActive = null)
 */
class ProductDiscountChangeIsActiveAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeIsActive');
    }

    /**
     * @param bool $isActive
     * @param Context|callable $context
     * @return ProductDiscountChangeIsActiveAction
     */
    public static function ofIsActive($isActive, $context = null)
    {
        return static::of($context)->setIsActive($isActive);
    }
}
