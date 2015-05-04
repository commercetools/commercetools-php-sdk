<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CategoryChangeOrderHintAction
 * @package Sphere\Core\Request\Categories\Command
 * @link http://dev.sphere.io/http-api-projects-categories.html#change-order-hint
 * @method string getOrderHint()
 * @method CategoryChangeOrderHintAction setOrderHint(string $orderHint = null)
 * @method string getAction()
 * @method CategoryChangeOrderHintAction setAction(string $action = null)
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
