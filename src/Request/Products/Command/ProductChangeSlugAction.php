<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductChangeSlugAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductChangeSlugAction setAction(string $action)
 * @method LocalizedString getSlug()
 * @method ProductChangeSlugAction setSlug(LocalizedString $slug)
 * @method bool getStaged()
 * @method ProductChangeSlugAction setStaged(bool $staged)
 */
class ProductChangeSlugAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'slug' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param LocalizedString $slug
     */
    public function __construct(LocalizedString $slug)
    {
        $this->setAction('changeSlug');
        $this->setSlug($slug);
    }
}
