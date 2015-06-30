<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class DiscountCodeSetMaxApplicationsPerCustomerAction
 * @package Sphere\Core\Request\DiscountCodes\Command
 * 
 * @method string getAction()
 * @method DiscountCodeSetMaxApplicationsPerCustomerAction setAction(string $action = null)
 * @method int getMaxApplicationsPerCustomer()
 * @codingStandardsIgnoreStart
 * @method DiscountCodeSetMaxApplicationsPerCustomerAction setMaxApplicationsPerCustomer(int $maxApplicationsPerCustomer = null)
 * @codingStandardsIgnoreEnd
 */
class DiscountCodeSetMaxApplicationsPerCustomerAction extends AbstractAction
{
    public function getFields()
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
}
