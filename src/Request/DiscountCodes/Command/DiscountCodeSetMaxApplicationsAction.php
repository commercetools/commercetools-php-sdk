<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\DiscountCodes\Command
 * 
 * @method string getAction()
 * @method DiscountCodeSetMaxApplicationsAction setAction(string $action = null)
 * @method int getMaxApplications()
 * @method DiscountCodeSetMaxApplicationsAction setMaxApplications(int $maxApplications = null)
 */
class DiscountCodeSetMaxApplicationsAction extends AbstractAction
{
    public function getFields()
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
