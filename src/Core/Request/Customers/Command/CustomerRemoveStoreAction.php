<?php

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-customers.html#remove-store-beta
 *
 * @method string getAction()
 * @method CustomerRemoveStoreAction setAction(string $action = null)
 * @method StoreReference getStore()
 * @method CustomerRemoveStoreAction setStore(StoreReference $store = null)
 */
class CustomerRemoveStoreAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'store' => [static::TYPE => StoreReference::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeStore');
    }

    /**
     * @param StoreReference $store
     * @param Context|callable $context
     * @return CustomerRemoveStoreAction
     */
    public static function ofStore(StoreReference $store, $context = null)
    {
        return static::of($context)->setStore($store);
    }
}
