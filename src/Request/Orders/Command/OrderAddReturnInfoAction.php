<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\ReturnItemCollection;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#add-return-info
 * @method string getAction()
 * @method OrderAddReturnInfoAction setAction(string $action = null)
 * @method DateTimeDecorator getReturnDate()
 * @method OrderAddReturnInfoAction setReturnDate(\DateTime $returnDate = null)
 * @method string getReturnTrackingId()
 * @method OrderAddReturnInfoAction setReturnTrackingId(string $returnTrackingId = null)
 * @method ReturnItemCollection getItems()
 * @method OrderAddReturnInfoAction setItems(ReturnItemCollection $items = null)
 */
class OrderAddReturnInfoAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'returnDate' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
            'returnTrackingId' => [static::TYPE => 'string'],
            'items' => [static::TYPE => '\Sphere\Core\Model\Order\ReturnItemCollection']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addReturnInfo');
    }
}
