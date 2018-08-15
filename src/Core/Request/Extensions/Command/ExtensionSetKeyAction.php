<?php
/**
 */

namespace Commercetools\Core\Request\Extensions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Extensions\Command
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#set-key
 * @method string getAction()
 * @method ExtensionSetKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method ExtensionSetKeyAction setKey(string $key = null)
 */
class ExtensionSetKeyAction extends AbstractAction
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
