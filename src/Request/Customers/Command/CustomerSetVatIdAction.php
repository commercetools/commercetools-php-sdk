<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://dev.commercetools.com/http-api-projects-customers.html#set-vat-id
 * @method string getVatId()
 * @method CustomerSetVatIdAction setVatId(string $vatId = null)
 * @method string getAction()
 * @method CustomerSetVatIdAction setAction(string $action = null)
 */
class CustomerSetVatIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'vatId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setVatId');
    }
}
