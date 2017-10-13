<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\ResourceIdentifier;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#set-target
 * @method string getAction()
 * @method ReviewSetTargetAction setAction(string $action = null)
 * @method ResourceIdentifier getTarget()
 * @method ReviewSetTargetAction setTarget(ResourceIdentifier $target = null)
 */
class ReviewSetTargetAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'target' => [static::TYPE => ResourceIdentifier::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTarget');
    }
}
