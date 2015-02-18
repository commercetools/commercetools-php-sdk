<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CategorySetDescriptionAction
 * @package Sphere\Core\Request\Categories\Command
 * @method string getOrderHint()
 * @method CategoryChangeOrderHintAction setOrderHint(string $orderHint)
 */
class CategoryChangeOrderHintAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'orderHint' => [static::TYPE => 'string']
        ];
    }

    public function __construct($orderHint)
    {
        $this->setAction('changeOrderHint');
        $this->setOrderHint($orderHint);
    }
}
