<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/http-api-projects-project.html#change-messages-enabled
 * @method string getAction()
 * @method ProjectChangeMessagesEnabledAction setAction(string $action = null)
 * @method bool getMessagesEnabled()
 * @method ProjectChangeMessagesEnabledAction setMessagesEnabled(bool $messagesEnabled = null)
 */
class ProjectChangeMessagesEnabledAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'messagesEnabled' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeMessagesEnabled');
    }

    /**
     * @param bool $messagesEnabled
     * @param Context|callable $context
     * @return ProjectChangeMessagesEnabledAction
     */
    public static function ofMessagesEnabled($messagesEnabled, $context = null)
    {
        return static::of($context)->setMessagesEnabled($messagesEnabled);
    }
}
