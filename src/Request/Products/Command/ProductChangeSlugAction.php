<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductChangeSlugAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#change-slug
 * @method string getAction()
 * @method ProductChangeSlugAction setAction(string $action = null)
 * @method LocalizedString getSlug()
 * @method ProductChangeSlugAction setSlug(LocalizedString $slug = null)
 * @method bool getStaged()
 * @method ProductChangeSlugAction setStaged(bool $staged = null)
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeSlug');
    }

    /**
     * @param LocalizedString $slug
     * @param Context|callable $context
     * @return ProductChangeSlugAction
     */
    public static function ofSlug(LocalizedString $slug, $context = null)
    {
        return static::of($context)->setSlug($slug);
    }
}
