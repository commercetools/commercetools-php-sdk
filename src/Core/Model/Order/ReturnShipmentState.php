<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#returnshipmentstate
 */
class ReturnShipmentState
{
    const ADVISED = 'Advised';
    const RETURNED = 'Returned';
    const BACK_IN_STOCK = 'BackInStock';
    const UNUSABLE = 'Unusable';
}
