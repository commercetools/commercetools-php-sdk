<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Channels\Command
 *  *
 * @method string getAction()
 * @method ChannelChangeKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method ChannelChangeKeyAction setKey(string $key = null)
 */
class ChannelChangeKeyAction extends AbstractAction
{
    public function getFields()
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
