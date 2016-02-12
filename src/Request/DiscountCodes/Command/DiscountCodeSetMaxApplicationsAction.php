<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#set-maxApplications
 * @method string getAction()
 * @method DiscountCodeSetMaxApplicationsAction setAction(string $action = null)
 * @method int getMaxApplications()
 * @method DiscountCodeSetMaxApplicationsAction setMaxApplications(int $maxApplications = null)
 */
class DiscountCodeSetMaxApplicationsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'maxApplications' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMaxApplications');
    }
}
