<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#set-name
 * @method string getAction()
 * @method DiscountCodeSetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method DiscountCodeSetNameAction setName(LocalizedString $name = null)
 */
class DiscountCodeSetNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setName');
    }
}
