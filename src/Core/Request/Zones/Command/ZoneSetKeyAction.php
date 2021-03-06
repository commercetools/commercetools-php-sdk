<?php
/**
 */

namespace Commercetools\Core\Request\Zones\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Zones\Command
 * @link https://docs.commercetools.com/http-api-projects-zones.html#set-key
 * @method string getAction()
 * @method ZoneSetKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method ZoneSetKeyAction setKey(string $key = null)
 */
class ZoneSetKeyAction extends AbstractAction
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


    /**
     * @param string $key
     * @param Context|callable $context
     * @return ZoneSetKeyAction
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
