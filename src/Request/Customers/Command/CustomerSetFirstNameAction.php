<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link http://dev.commercetools.com/http-api-projects-customers.html#set-first-name
 * @method string getAction()
 * @method CustomerSetFirstNameAction setAction(string $action = null)
 * @method string getFirstName()
 * @method CustomerSetFirstNameAction setFirstName(string $firstName = null)
 */
class CustomerSetFirstNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setFirstName');
    }
}
