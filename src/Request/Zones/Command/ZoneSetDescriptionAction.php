<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ZoneSetDescriptionAction
 * @package Sphere\Core\Request\Zones\Command
 * 
 * @method string getAction()
 * @method ZoneSetDescriptionAction setAction(string $action = null)
 * @method string getDescription()
 * @method ZoneSetDescriptionAction setDescription(string $description = null)
 */
class ZoneSetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
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
