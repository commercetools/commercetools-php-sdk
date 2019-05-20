<?php
/**
 */

namespace Commercetools\Core\Request\Extensions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Extensions\Command
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#set-timeoutinms
 * @method string getAction()
 * @method ExtensionSetTimeoutInMsAction setAction(string $action = null)
 * @method int getTimeoutInMs()
 * @method ExtensionSetTimeoutInMsAction setTimeoutInMs(int $timeoutInMs = null)
 */
class ExtensionSetTimeoutInMsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'timeoutInMs' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTimeoutInMs');
    }
}
