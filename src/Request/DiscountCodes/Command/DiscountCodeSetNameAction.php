<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class DiscountCodeSetNameAction
 * @package Sphere\Core\Request\DiscountCodes\Command
 * 
 * @method string getAction()
 * @method DiscountCodeSetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method DiscountCodeSetNameAction setName(LocalizedString $name = null)
 */
class DiscountCodeSetNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
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
