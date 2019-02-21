<?php
/**
 */

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Message\MessagesConfigurationDraft;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/http-api-projects-project.html#change-messages-enabled
 * @method string getAction()
 * @method ProjectChangeMessagesConfigurationAction setAction(string $action = null)
 * @method bool getMessagesEnabled()
 * @method ProjectChangeMessagesConfigurationAction setMessagesEnabled(bool $messagesEnabled = null)
 * @method MessagesConfigurationDraft getMessagesConfiguration()
 * phpcs:disable
 * @method ProjectChangeMessagesConfigurationAction setMessagesConfiguration(MessagesConfigurationDraft $messagesConfiguration = null)
 * phpcs:enable
 */
class ProjectChangeMessagesConfigurationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'messagesConfiguration' => [static::TYPE => MessagesConfigurationDraft::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeMessagesConfiguration');
    }

    /**
     * @param MessagesConfigurationDraft $draft
     * @param Context|callable $context
     * @return ProjectChangeMessagesConfigurationAction
     */
    public static function ofDraft(MessagesConfigurationDraft $draft, $context = null)
    {
        return static::of($context)->setMessagesConfiguration($draft);
    }
}
