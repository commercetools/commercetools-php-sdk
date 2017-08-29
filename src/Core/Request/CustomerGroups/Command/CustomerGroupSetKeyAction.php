<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CustomerGroups\Command
 * @link https://dev.commercetools.com/http-api-projects-customerGroups.html#set-key
 * @method string getAction()
 * @method CustomerGroupSetKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method CustomerGroupSetKeyAction setKey(string $key = null)
 */
class CustomerGroupSetKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setKey');
    }
}
