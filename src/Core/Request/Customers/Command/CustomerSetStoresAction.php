<?php

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\Store\StoreReferenceCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-customers.html#set-stores-beta
 *
 * @method string getAction()
 * @method CustomerSetStoresAction setAction(string $action = null)
 * @method StoreReferenceCollection getStores()
 * @method CustomerSetStoresAction setStores(StoreReferenceCollection $stores = null)
 */
class CustomerSetStoresAction extends AbstractAction
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'stores' => [static::TYPE => StoreReferenceCollection::class],
        ];
    }

    /**
     * @param StoreReferenceCollection $stores
     * @param Context|callable $context
     * @return CustomerSetStoresAction
     */
    public static function ofStores(StoreReferenceCollection $stores, $context = null)
    {
        return static::of($context)->setStores($stores);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setStores');
    }
}
