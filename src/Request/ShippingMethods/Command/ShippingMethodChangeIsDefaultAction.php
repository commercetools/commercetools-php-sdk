<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ShippingMethodChangeIsDefaultAction
 * @package Sphere\Core\Request\ShippingMethods\Command
 *  *
 * @method string getAction()
 * @method ShippingMethodChangeIsDefaultAction setAction(string $action = null)
 * @method bool getIsDefault()
 * @method ShippingMethodChangeIsDefaultAction setIsDefault(bool $isDefault = null)
 */
class ShippingMethodChangeIsDefaultAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'isDefault' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeIsDefault');
    }

    /**
     * @param bool $isDefault
     * @param Context|callable $context
     * @return ShippingMethodChangeIsDefaultAction
     */
    public static function ofIsDefault($isDefault, $context = null)
    {
        return static::of($context)->setIsDefault($isDefault);
    }
}
