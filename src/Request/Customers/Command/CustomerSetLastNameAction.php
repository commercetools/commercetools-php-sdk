<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link http://dev.commercetools.com/http-api-projects-customers.html#set-last-name
 * @method string getAction()
 * @method CustomerSetLastNameAction setAction(string $action = null)
 * @method string getLastName()
 * @method CustomerSetLastNameAction setLastName(string $lastName = null)
 */
class CustomerSetLastNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lastName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLastName');
    }
}
