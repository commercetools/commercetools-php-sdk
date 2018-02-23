<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\ReturnItemCollection;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#addreturninfo
 * @method string getAction()
 * @method OrderAddReturnInfoAction setAction(string $action = null)
 * @method DateTimeDecorator getReturnDate()
 * @method OrderAddReturnInfoAction setReturnDate(DateTime $returnDate = null)
 * @method string getReturnTrackingId()
 * @method OrderAddReturnInfoAction setReturnTrackingId(string $returnTrackingId = null)
 * @method ReturnItemCollection getItems()
 * @method OrderAddReturnInfoAction setItems(ReturnItemCollection $items = null)
 */
class OrderAddReturnInfoAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'returnDate' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'returnTrackingId' => [static::TYPE => 'string'],
            'items' => [static::TYPE => ReturnItemCollection::class]
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
