<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-store-beta
 * @method string getAction()
 * @method OrderSetStoreAction setAction(string $action = null)
 * @method StoreReference getStore()
 * @method OrderSetStoreAction setStore(StoreReference $store = null)
 */
class OrderSetStoreAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'store' => [static::TYPE => StoreReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setStore');
    }
}
