<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Subscription\ChangeSubscriptionCollection;

/**
 * @package Commercetools\Core\Request\Subscriptions\Command
 * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-changes
 * @method string getAction()
 * @method SubscriptionSetChangesAction setAction(string $action = null)
 * @method ChangeSubscriptionCollection getChanges()
 * @method SubscriptionSetChangesAction setChanges(ChangeSubscriptionCollection $changes = null)
 */
class SubscriptionSetChangesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'changes' => [static::TYPE => ChangeSubscriptionCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setChanges');
    }
}
