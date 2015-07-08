<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * Class CartDiscountSetValidFromAction
 * @package Sphere\Core\Request\CartDiscounts\Command
 *  *
 * @method string getAction()
 * @method CartDiscountSetValidFromAction setAction(string $action = null)
 * @method DateTimeDecorator getValidFrom()
 * @method CartDiscountSetValidFromAction setValidFrom(\DateTime $validFrom = null)
 */
class CartDiscountSetValidFromAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'validFrom' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
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
        $this->setAction('setValidFrom');
    }
}
