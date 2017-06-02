<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#set-max-applications-per-customer
 * @method string getAction()
 * @method DiscountCodeSetMaxApplicationsPerCustomerAction setAction(string $action = null)
 * @method int getMaxApplicationsPerCustomer()
 */
class DiscountCodeSetMaxApplicationsPerCustomerAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMaxApplicationsPerCustomer');
    }

    /**
     * @param int $maxApplicationsPerCustomer
     * @return static
     */
    public function setMaxApplicationsPerCustomer($maxApplicationsPerCustomer = null)
    {
        return parent::setMaxApplicationsPerCustomer($maxApplicationsPerCustomer);
    }
}
