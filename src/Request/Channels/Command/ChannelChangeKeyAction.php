<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Channels\Command
 * @link https://dev.commercetools.com/http-api-projects-channels.html#change-key
 * @method string getAction()
 * @method ChannelChangeKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method ChannelChangeKeyAction setKey(string $key = null)
 */
class ChannelChangeKeyAction extends AbstractAction
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
     * @return ChannelChangeKeyAction
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
