<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-items
 * @method string getAction()
 * @method OrderSetParcelItemsAction setAction(string $action = null)
 * @method string getParcelId()
 * @method OrderSetParcelItemsAction setParcelId(string $parcelId = null)
 * @method DeliveryItemCollection getItems()
 * @method OrderSetParcelItemsAction setItems(DeliveryItemCollection $items = null)
 */
class OrderSetParcelItemsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'parcelId' => [static::TYPE => 'string'],
            'items' => [static::TYPE => DeliveryItemCollection::class]
        ];
    }

    /**
     * @param string $parcelId
     * @param Context|callable $context
     * @return OrderSetParcelItemsAction
     */
    public static function ofParcel($parcelId, $context = null)
    {
        return static::of($context)->setParcelId($parcelId);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setParcelItems');
    }
}
