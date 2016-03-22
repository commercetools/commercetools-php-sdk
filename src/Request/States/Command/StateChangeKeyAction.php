<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 * @link https://dev.commercetools.com/http-api-projects-states.html#change-key
 * @method string getAction()
 * @method StateChangeKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method StateChangeKeyAction setKey(string $key = null)
 */
class StateChangeKeyAction extends AbstractAction
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
        $this->setAction('changeKey');
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return StateChangeKeyAction
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
