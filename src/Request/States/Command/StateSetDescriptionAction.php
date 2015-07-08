<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class StateSetDescriptionAction
 * @package Sphere\Core\Request\States\Command
 * 
 * @method string getAction()
 * @method StateSetDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method StateSetDescriptionAction setDescription(LocalizedString $description = null)
 */
class StateSetDescriptionAction extends AbstractAction
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

    /**
     * @param LocalizedString $description
     * @param Context|callable $context
     * @return StateSetDescriptionAction
     */
    public function ofDescription(LocalizedString $description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
