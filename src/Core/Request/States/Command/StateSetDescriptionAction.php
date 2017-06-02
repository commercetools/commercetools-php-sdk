<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 * @link https://dev.commercetools.com/http-api-projects-states.html#set-state-description
 * @method string getAction()
 * @method StateSetDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method StateSetDescriptionAction setDescription(LocalizedString $description = null)
 */
class StateSetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }

    /**
     * @param LocalizedString $description
     * @param Context|callable $context
     * @return StateSetDescriptionAction
     */
    public static function ofDescription(LocalizedString $description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
