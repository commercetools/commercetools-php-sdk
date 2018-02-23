<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\Channels\Command
 * @link https://docs.commercetools.com/http-api-projects-channels.html#set-address
 * @method string getAction()
 * @method ChannelSetAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method ChannelSetAddressAction setAddress(Address $address = null)
 */
class ChannelSetAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => Address::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAddress');
    }
}
