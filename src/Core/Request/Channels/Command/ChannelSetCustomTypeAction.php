<?php
/**
 *
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Channels\Command
 *
 * @method string getAction()
 * @method ChannelSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method ChannelSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method ChannelSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class ChannelSetCustomTypeAction extends SetCustomTypeAction
{
}
