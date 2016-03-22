<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://dev.commercetools.com/http-api-projects-customers.html#set-company-name
 * @method string getCompanyName()
 * @method CustomerSetCompanyNameAction setCompanyName(string $companyName = null)
 * @method string getAction()
 * @method CustomerSetCompanyNameAction setAction(string $action = null)
 */
class CustomerSetCompanyNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'companyName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCompanyName');
    }
}
