<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#set-customer
 * @method string getAction()
 * @method ReviewSetCustomerAction setAction(string $action = null)
 * @method CustomerReference getCustomer()
 * @method ReviewSetCustomerAction setCustomer(CustomerReference $customer = null)
 */
class ReviewSetCustomerAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customer' => [static::TYPE => '\Commercetools\Core\Model\Customer\CustomerReference'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomer');
    }
}
