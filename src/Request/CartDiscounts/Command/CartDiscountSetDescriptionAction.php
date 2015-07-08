<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartDiscountSetDescriptionAction
 * @package Sphere\Core\Request\CartDiscounts\Command
 *  *
 * @method string getAction()
 * @method CartDiscountSetDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method CartDiscountSetDescriptionAction setDescription(LocalizedString $description = null)
 */
class CartDiscountSetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }
}
