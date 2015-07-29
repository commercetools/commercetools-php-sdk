<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * @package Sphere\Core\Request\DiscountCodes\Command
 * 
 * @method string getAction()
 * @method DiscountCodeSetDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method DiscountCodeSetDescriptionAction setDescription(LocalizedString $description = null)
 */
class DiscountCodeSetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }
}
