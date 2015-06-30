<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class DiscountCodeChangeIsActiveAction
 * @package Sphere\Core\Request\DiscountCodes\Command
 *
 * @method string getAction()
 * @method DiscountCodeChangeIsActiveAction setAction(string $action = null)
 * @method bool getIsActive()
 * @method DiscountCodeChangeIsActiveAction setIsActive(bool $isActive = null)
 */
class DiscountCodeChangeIsActiveAction extends AbstractAction
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
     * @return DiscountCodeChangeIsActiveAction
     */
    public static function ofIsActive($isActive, $context = null)
    {
        return static::of($context)->setIsActive($isActive);
    }
}
