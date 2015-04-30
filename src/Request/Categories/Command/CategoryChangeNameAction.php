<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CategoryChangeNameAction
 * @package Sphere\Core\Request\Categories\Command
 * @link http://dev.sphere.io/http-api-projects-categories.html#change-name
 * @method LocalizedString getName()
 * @method CategoryChangeNameAction setName(LocalizedString $name = null)
 * @method string getAction()
 * @method CategoryChangeNameAction setAction(string $action = null)
 */
class CategoryChangeNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString']
        ];
    }

    public function __construct(LocalizedString $name)
    {
        $this->setAction('changeName');
        $this->setName($name);
    }
}
