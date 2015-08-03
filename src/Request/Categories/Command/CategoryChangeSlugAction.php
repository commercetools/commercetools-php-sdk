<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @apidoc http://dev.sphere.io/http-api-projects-categories.html#change-slug
 * @method LocalizedString getSlug()
 * @method CategoryChangeSlugAction setSlug(LocalizedString $slug = null)
 * @method string getAction()
 * @method CategoryChangeSlugAction setAction(string $action = null)
 */
class CategoryChangeSlugAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'slug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString']
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
     * @return CategoryChangeSlugAction
     */
    public static function ofSlug(LocalizedString $slug, $context = null)
    {
        return static::of($context)->setSlug($slug);
    }
}
