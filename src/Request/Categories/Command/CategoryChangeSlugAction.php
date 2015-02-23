<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CategoryChangeSlugAction
 * @package Sphere\Core\Request\Categories\Command
 * @method LocalizedString getSlug()
 * @method CategoryChangeSlugAction setSlug(LocalizedString $slug)
 * @method string getAction()
 * @method CategoryChangeSlugAction setAction(string $action)
 */
class CategoryChangeSlugAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'slug' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString']
        ];
    }

    public function __construct(LocalizedString $slug)
    {
        $this->setAction('changeSlug');
        $this->setSlug($slug);
    }
}
