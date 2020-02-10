<?php

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-customers.html#add-store-beta
 *
 * @method string getAction()
 * @method CustomerAddStoreAction setAction(string $action = null)
 * @method StoreReference getStore()
 * @method CustomerAddStoreAction setStore(StoreReference $store = null)
 */
class CustomerAddStoreAction extends AbstractAction
{
    use LocaleTrait;

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
        $this->setAction('addStore');
    }

    /**
     * @param StoreReference $store
     * @param Context|callable $context
     * @return CustomerAddStoreAction
     */
    public static function ofStore(StoreReference $store, $context = null)
    {
        return static::of($context)->setStore($store);
    }
}
